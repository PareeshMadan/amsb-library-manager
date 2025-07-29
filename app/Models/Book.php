<?php

namespace App\Models;

use CodeIgniter\Model;

class Book extends Model
{
    protected $table            = 'books';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['title', 'author', 'genre', 'publication_year', 'image_path'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'title' => 'required|max_length[255]',
        'author' => 'required|max_length[255]',
        'genre' => 'permit_empty|max_length[100]',
        'publication_year' => 'required|integer|greater_than[1000]|less_than_equal_to[2025]',
    ];
    
    protected $validationMessages = [
        'title' => [
            'required' => 'Book title is required.',
            'max_length' => 'Title cannot exceed 255 characters.'
        ],
        'author' => [
            'required' => 'Author name is required.',
            'max_length' => 'Author name cannot exceed 255 characters.'
        ],
        'publication_year' => [
            'required' => 'Publication year is required.',
            'integer' => 'Publication year must be a valid number.',
            'greater_than' => 'Publication year must be greater than 1000.',
            'less_than_equal_to' => 'Publication year cannot be in the future.'
        ]
    ];

    // Method to get validation rules with dynamic current year
    public function getValidationRules(array $options = []): array
    {
        $rules = $this->validationRules;
        $rules['publication_year'] = 'required|integer|greater_than[1000]|less_than_equal_to[' . date('Y') . ']';
        return $rules;
    }

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
