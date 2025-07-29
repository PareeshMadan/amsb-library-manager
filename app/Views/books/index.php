<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-book me-2"></i><?= $title ?></h1>
    <a href="<?= base_url('books/create') ?>" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i>Add New Book
    </a>
</div>

<?php if (empty($books)): ?>
    <div class="card">
        <div class="card-body text-center py-5">
            <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
            <h3 class="text-muted">No Books Found</h3>
            <p class="text-muted">Start building your library by adding your first book.</p>
            <a href="<?= base_url('books/create') ?>" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>Add Your First Book
            </a>
        </div>
    </div>
<?php else: ?>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Cover</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Genre</th>
                            <th>Publication Year</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($books as $book): ?>
                            <tr>
                                <td>
                                    <?php if ($book['image_path']): ?>
                                        <img src="<?= base_url($book['image_path']) ?>" 
                                             alt="<?= esc($book['title']) ?>" 
                                             class="book-image">
                                    <?php else: ?>
                                        <div class="book-image default-book-image">
                                            <i class="fas fa-book"></i>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <strong><?= esc($book['title']) ?></strong>
                                </td>
                                <td><?= esc($book['author']) ?></td>
                                <td><?= esc($book['genre']) ?: '<span class="text-muted">Not specified</span>' ?></td>
                                <td><?= esc($book['publication_year']) ?></td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="<?= base_url('books/show/' . $book['id']) ?>" 
                                           class="btn btn-sm btn-outline-info" 
                                           title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="<?= base_url('books/edit/' . $book['id']) ?>" 
                                           class="btn btn-sm btn-outline-primary" 
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-danger" 
                                                onclick="confirmDelete('<?= base_url('books/delete/' . $book['id']) ?>', '<?= esc($book['title']) ?>')"
                                                title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3 text-muted">
        <small><i class="fas fa-info-circle me-1"></i>Total books: <?= count($books) ?></small>
    </div>
<?php endif; ?>

<?= $this->endSection() ?>
