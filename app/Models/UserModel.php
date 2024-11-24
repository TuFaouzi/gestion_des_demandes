<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'firstName',
        'lastName',
        'phoneNumber',
        'email',
        'password',
        'role',
        'created_at',
        'updated_at',
    ];

    // Define validation rules
    protected $validationRules = [
        'firstName' => 'required|min_length[2]|max_length[50]',
        'lastName' => 'required|min_length[2]|max_length[50]',
        'email' => 'required|valid_email|is_unique[users.email]',
        'phoneNumber' => 'required|numeric|is_unique[users.phoneNumber]',
        'password' => 'required|min_length[6]',
    ];

    protected $validationMessages = [
        'firstName'=> [
            'required' => 'Le prénom est requis',
            'min_length' => "Minimum 2 caractères",
            'max_length' => "Maximum 50 caractères"
        ],
        'lastName'=> [
            'required' => 'Le nom est requis',
            'min_length' => "Minimum 2 caractères",
            'max_length' => "Maximum 50 caractères"
        ],
        'email' => [
            'required' => "L'email est requis",
            'is_unique' => 'Cette addresse mail existe déjà',
            'valid_email' => "L'email n'est pas valide"
        ],
        'phoneNumber' => [
            'required' => 'Le numéro de téléphone est requis',
            'numeric' => "Le numéro de téléphone n'est pas valide",
            'is_unique' => 'Ce numéro de téléphone est déjà enregistré',
        ],
        'password' => [
            'required' => "Le mot de passe est requis",
            'min_length' => "Minimum 6 caractères"
        ]
    ];

    protected $useTimestamps = true;
}
