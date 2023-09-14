<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SectionSeeder extends Seeder
{
    public function run(): void
    {

        DB::table('sections')->truncate();

        DB::table('sections')->insert([
            'name' => 'Certificat de Résidence',
            'description' => 'Le Certificat de Résidence est un document officiel qui confirme la résidence légale d\'un étranger au Maroc, souvent nécessaire pour des formalités administratives et bancaires.',
            'created_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('sections')->insert([
            'name' => 'Actes d\'État Civil ',
            'description' => 'Les actes de naissance, de mariage et de décès sont des documents administratifs importants qui sont souvent requis pour différentes procédures',
            'created_by' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('sections')->insert([
            'name' => 'Acte de Propriété ',
            'description' => "C'est un document officiel qui prouve la propriété légale d'une parcelle de terrain. Il est essentiel lors de l'achat d'un terrain",
            'created_by' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('sections')->insert([
            'name' => 'Certificat de Situation Foncière (CSF)',
            'description' => "Ce document fournit des informations détaillées sur la situation juridique d'un terrain, y compris les détails de propriété, les hypothèques ou les charges éventuelles",
            'created_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('sections')->insert([
            'name' => 'Autorisations de Construction',
            'description' => 'Pour développer un terrain, vous devrez obtenir diverses autorisations de construction auprès des autorités préfectorales',
            'created_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('sections')->insert([
            'name' => 'Autorisation de Lotissement ',
            'description' => 'Si le terrain fait partie d\'un projet de lotissement, une autorisation de lotissement est nécessaire pour diviser le terrain en parcelles plus petites',
            'created_by' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('sections')->insert([
            'name' => 'Autorisation de Bâtir',
            'description' => ': Ce document est nécessaire pour la construction de bâtiments sur le terrain et doit être obtenu auprès des autorités compétentes.',
            'created_by' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('sections')->insert([
            'name' => 'Autorisation d\'Occupation de l\'Espace Public',
            'description' => 'cest un permis officiel délivré par les autorités locales permettant aux entreprises d\'utiliser temporairement des espaces publics',
            'created_by' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
