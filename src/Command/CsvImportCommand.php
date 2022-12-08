<?php

namespace App\Command;

use App\Entity\Arrondissement;
use App\Entity\Commune;
use App\Entity\Departement;
use Doctrine\ORM\EntityManagerInterface;
use League\Csv\ByteSequence;
use League\Csv\Reader;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpKernel\KernelInterface;

#[AsCommand(
    name: 'app:csv-import',
    description: 'Import a csv file using league/csv',
)]
class CsvImportCommand extends Command
{
    public function __construct(private readonly EntityManagerInterface $em, private readonly KernelInterface $kernel, string $name = null)
    {
        parent::__construct($name);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $status = false;
        $error_details = '';

        $file_name = $this->kernel->getProjectDir().'/imports/liste-arrondissement.csv';
        $io->note(sprintf('Importing arrondissements from  %s', $file_name));
        $csv = Reader::createFromPath($file_name);
        $inputBOM = $csv->getInputBOM();
        if($inputBOM !== ByteSequence::BOM_UTF8) {
            //let's set the output BOM
            $csv->setOutputBOM(ByteSequence::BOM_UTF8);
            //let's convert the incoming data from iso-88959-15 to utf-8
            $csv->addStreamFilter('convert.iconv.ISO-8859-15/UTF-8');
        }

        $csv->setDelimiter(';');
        $csv->setHeaderOffset(0);
        $header = $csv->getHeader(); //returns the CSV header record
        $records = $csv->getRecords(); //returns all the CSV records as an Iterator object
        $cpt = 0;
        $new = 0;
        $doublon = [];

        foreach ($records as $k => $record) {
            $departementName = $record[$header[0]];
//            $ce = intval($record[$header[1]]);
            $communeName = $record[$header[2]];
            $arrondissementName = $record[$header[3]];
            $nbInscrits = intval($record[$header[4]]);

            $arrondissement = $this->findOrCreateArrondissement($arrondissementName, $communeName, $departementName, $nbInscrits, $this->em, $new, $doublon);;


            if($arrondissement!==null) {
                $this->em->persist($arrondissement);
                $this->em->flush();
                $cpt++;
            } else {
                $io->error('Erreur.');
                return Command::FAILURE;
            }

        }

        $io->success("Everything went well. ($cpt arrondissements traités dont $new nouveaux)");
//        dump($doublon);

        return Command::SUCCESS;
    }

    private function findOrCreateArrondissement(
        $arrondissementName,
        $communeName,
        $departementName,
        $nbInscrits,
        EntityManagerInterface $manager,
        int &$new,
        array &$doublon
    ): ?Arrondissement {
        if($arrondissementName === null || trim($arrondissementName) === ''){
            return null;
        }

        $arrondissement = $manager->getRepository(Arrondissement::class)->findOneBy(['nom' => $arrondissementName, 'nbInscrits' => $nbInscrits]);
        if (null === $arrondissement) {
            $arrondissement = new Arrondissement();
            $commune = self::findOrCreateCommune($communeName, $departementName, $manager);
            if (!$commune){
                return null;
            }
            $arrondissement
                ->setNom($arrondissementName)
                ->setCommune($commune)
                ->setNbInscrits($nbInscrits)
            ;
            $manager->persist($arrondissement);
            $manager->flush();
            $new++;
        } else {
            $doublon[] = [
                'ancien' => $departementName,
                'commune' => $communeName,
                'arrondissement' => $arrondissementName
            ];
        }

        return $arrondissement;
    }

    public function findOrCreateCommune($communeName, $departementName, $manager): ?Commune
    {
        if($communeName === null || trim($communeName) === '')
            return null;

        $commune = $manager->getRepository(Commune::class)->findOneBy(['nom' => $communeName]);
        if(null===$commune) {
            $commune = new Commune();
            $departement = $this->findOrCreateDepartement($departementName, $manager);
            if (!$departement){
                return null;
            }
            $commune
                ->setNom($communeName)
                ->setDepartement($departement)
            ;
            $manager->persist($commune);
            $manager->flush();
        }

        return $commune;
    }


    public static function findOrCreateDepartement($departementName, $manager): ?Departement
    {
        if($departementName === null || trim($departementName) === ''){
            return null;
        }

        $departement = $manager->getRepository(Departement::class)->findOneBy(['nom' => $departementName]);
        if(null === $departement) {
            $departement = new Departement();
            $departement->setNom($departementName);
            $manager->persist($departement);
            $manager->flush();
        }

        return $departement;
    }
}
