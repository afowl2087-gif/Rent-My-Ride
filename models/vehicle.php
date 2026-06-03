<?php

class Vehicle {

    public static function getAllVehicles(){

        return [

            [
                'id' => 1,
                'brand' => 'BMW',
                'model' => 'Serie 3',
                'price' => '90€/jour',
                'category' => 'Berline',
                'image' => 'images/car1.jpg',
                'description' => 'Berline premium confortable.'
            ],

            [
                'id' => 2,
                'brand' => 'Audi',
                'model' => 'A5',
                'price' => '120€/jour',
                'category' => 'Cabriolet',
                'image' => 'images/car2.jpg',
                'description' => 'Voiture sportive élégante.'
            ],

            [
                'id' => 3,
                'brand' => 'Peugeot',
                'model' => '308',
                'price' => '60€/jour',
                'category' => 'Citadine',
                'image' => 'images/car3.jpg',
                'description' => 'Voiture économique et pratique.'
            ]
        ];
    }

    public static function getVehicleById($id){

        foreach(self::getAllVehicles() as $vehicle){

            if($vehicle['id'] == $id){

                return $vehicle;
            }
        }
    }
}