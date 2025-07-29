<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Book;
use CodeIgniter\HTTP\ResponseInterface;

class Books extends BaseController
{
    protected $bookModel;

    public function __construct()
    {
        $this->bookModel = new Book();
        helper(['form', 'url']);
    }

    // Display list of all books
    public function index()
    {
        $data['books'] = $this->bookModel->findAll();
        $data['title'] = 'Library Books';
        
        return view('books/index', $data);
    }

    // Show form to create new book
    public function create()
    {
        $data['title'] = 'Add New Book';
        
        return view('books/create', $data);
    }

    // Store new book
    public function store()
    {
        // Validation rules
        $validationRules = [
            'title' => 'required|max_length[255]',
            'author' => 'required|max_length[255]',
            'genre' => 'permit_empty|max_length[100]',
            'publication_year' => 'required|integer|greater_than[1000]|less_than_equal_to[' . date('Y') . ']',
        ];

        // Add image validation if file is uploaded
        if ($this->request->getFile('image')->isValid()) {
            $validationRules['image'] = 'uploaded[image]|is_image[image]|max_size[image,2048]|ext_in[image,jpg,jpeg,png,gif]';
        }

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'author' => $this->request->getPost('author'),
            'genre' => $this->request->getPost('genre'),
            'publication_year' => $this->request->getPost('publication_year'),
        ];

        // Handle image upload
        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            $image->move(ROOTPATH . 'public/uploads/books', $newName);
            $data['image_path'] = 'uploads/books/' . $newName;
        }

        if ($this->bookModel->insert($data)) {
            return redirect()->to('/books')->with('success', 'Book added successfully!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Failed to add book. Please try again.');
        }
    }

    // Show single book
    public function show($id)
    {
        $book = $this->bookModel->find($id);
        
        if (!$book) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data['book'] = $book;
        $data['title'] = 'Book Details';
        
        return view('books/show', $data);
    }

    // Show form to edit book
    public function edit($id)
    {
        $book = $this->bookModel->find($id);
        
        if (!$book) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data['book'] = $book;
        $data['title'] = 'Edit Book';
        
        return view('books/edit', $data);
    }

    // Update book
    public function update($id)
    {
        $book = $this->bookModel->find($id);
        
        if (!$book) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Validation rules
        $validationRules = [
            'title' => 'required|max_length[255]',
            'author' => 'required|max_length[255]',
            'genre' => 'permit_empty|max_length[100]',
            'publication_year' => 'required|integer|greater_than[1000]|less_than_equal_to[' . date('Y') . ']',
        ];

        // Add image validation if file is uploaded
        if ($this->request->getFile('image')->isValid()) {
            $validationRules['image'] = 'uploaded[image]|is_image[image]|max_size[image,2048]|ext_in[image,jpg,jpeg,png,gif]';
        }

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'author' => $this->request->getPost('author'),
            'genre' => $this->request->getPost('genre'),
            'publication_year' => $this->request->getPost('publication_year'),
        ];

        // Handle image upload
        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            // Delete old image if exists
            if ($book['image_path'] && file_exists(ROOTPATH . 'public/' . $book['image_path'])) {
                unlink(ROOTPATH . 'public/' . $book['image_path']);
            }
            
            $newName = $image->getRandomName();
            $image->move(ROOTPATH . 'public/uploads/books', $newName);
            $data['image_path'] = 'uploads/books/' . $newName;
        }

        if ($this->bookModel->update($id, $data)) {
            return redirect()->to('/books')->with('success', 'Book updated successfully!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Failed to update book. Please try again.');
        }
    }

    // Delete book
    public function delete($id)
    {
        $book = $this->bookModel->find($id);
        
        if (!$book) {
            return redirect()->to('/books')->with('error', 'Book not found.');
        }

        // Delete image file if exists
        if ($book['image_path'] && file_exists(ROOTPATH . 'public/' . $book['image_path'])) {
            unlink(ROOTPATH . 'public/' . $book['image_path']);
        }

        if ($this->bookModel->delete($id)) {
            return redirect()->to('/books')->with('success', 'Book deleted successfully!');
        } else {
            return redirect()->to('/books')->with('error', 'Failed to delete book. Please try again.');
        }
    }
}
