<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3><i class="fas fa-book-open me-2"></i><?= esc($book['title']) ?></h3>
                <div class="btn-group">
                    <a href="<?= base_url('books/edit/' . $book['id']) ?>" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit me-1"></i>Edit
                    </a>
                    <button type="button" 
                            class="btn btn-sm btn-danger" 
                            onclick="confirmDelete('<?= base_url('books/delete/' . $book['id']) ?>', '<?= esc($book['title']) ?>')">
                        <i class="fas fa-trash me-1"></i>Delete
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <?php if ($book['image_path']): ?>
                            <img src="<?= base_url($book['image_path']) ?>" 
                                 alt="<?= esc($book['title']) ?>" 
                                 class="book-image-large mb-3">
                        <?php else: ?>
                            <div class="book-image-large default-book-image default-book-image-large mb-3">
                                <i class="fas fa-book"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="col-md-8">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td class="fw-bold" style="width: 150px;">
                                        <i class="fas fa-heading me-2 text-primary"></i>Title:
                                    </td>
                                    <td><?= esc($book['title']) ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">
                                        <i class="fas fa-user me-2 text-success"></i>Author:
                                    </td>
                                    <td><?= esc($book['author']) ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">
                                        <i class="fas fa-tags me-2 text-info"></i>Genre:
                                    </td>
                                    <td>
                                        <?php if ($book['genre']): ?>
                                            <span class="badge bg-secondary"><?= esc($book['genre']) ?></span>
                                        <?php else: ?>
                                            <span class="text-muted">Not specified</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">
                                        <i class="fas fa-calendar me-2 text-warning"></i>Publication Year:
                                    </td>
                                    <td><?= esc($book['publication_year']) ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">
                                        <i class="fas fa-clock me-2 text-muted"></i>Added:
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            <?= date('F j, Y \a\t g:i A', strtotime($book['created_at'])) ?>
                                        </small>
                                    </td>
                                </tr>
                                <?php if ($book['updated_at'] !== $book['created_at']): ?>
                                <tr>
                                    <td class="fw-bold">
                                        <i class="fas fa-edit me-2 text-muted"></i>Last Updated:
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            <?= date('F j, Y \a\t g:i A', strtotime($book['updated_at'])) ?>
                                        </small>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-cogs me-1"></i>Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="<?= base_url('books') ?>" class="btn btn-outline-secondary">
                        <i class="fas fa-list me-1"></i>Back to All Books
                    </a>
                    <a href="<?= base_url('books/edit/' . $book['id']) ?>" class="btn btn-outline-primary">
                        <i class="fas fa-edit me-1"></i>Edit This Book
                    </a>
                    <a href="<?= base_url('books/create') ?>" class="btn btn-outline-success">
                        <i class="fas fa-plus me-1"></i>Add Another Book
                    </a>
                    <hr>
                    <button type="button" 
                            class="btn btn-outline-danger" 
                            onclick="confirmDelete('<?= base_url('books/delete/' . $book['id']) ?>', '<?= esc($book['title']) ?>')">
                        <i class="fas fa-trash me-1"></i>Delete This Book
                    </button>
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h6><i class="fas fa-info-circle me-1"></i>Book Details</h6>
            </div>
            <div class="card-body">
                <small class="text-muted">
                    <strong>ID:</strong> #<?= $book['id'] ?><br>
                    <?php if ($book['image_path']): ?>
                        <strong>Has Cover Image:</strong> Yes<br>
                    <?php else: ?>
                        <strong>Has Cover Image:</strong> No<br>
                    <?php endif; ?>
                    <strong>Age:</strong> <?= date('Y') - $book['publication_year'] ?> years old
                </small>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
