<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3><i class="fas fa-edit me-2"></i><?= $title ?></h3>
            </div>
            <div class="card-body">
                <?= form_open_multipart('books/update/' . $book['id']) ?>
                    
                    <div class="row">
                        <div class="col-md-8">
                            <!-- Title -->
                            <div class="mb-3">
                                <label for="title" class="form-label">
                                    <i class="fas fa-heading me-1"></i>Book Title <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control <?= isset($errors['title']) ? 'is-invalid' : '' ?>" 
                                       id="title" 
                                       name="title" 
                                       value="<?= old('title', $book['title']) ?>" 
                                       placeholder="Enter book title"
                                       required>
                                <?php if (isset($errors['title'])): ?>
                                    <div class="invalid-feedback"><?= $errors['title'] ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Author -->
                            <div class="mb-3">
                                <label for="author" class="form-label">
                                    <i class="fas fa-user me-1"></i>Author <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control <?= isset($errors['author']) ? 'is-invalid' : '' ?>" 
                                       id="author" 
                                       name="author" 
                                       value="<?= old('author', $book['author']) ?>" 
                                       placeholder="Enter author name"
                                       required>
                                <?php if (isset($errors['author'])): ?>
                                    <div class="invalid-feedback"><?= $errors['author'] ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Genre -->
                            <div class="mb-3">
                                <label for="genre" class="form-label">
                                    <i class="fas fa-tags me-1"></i>Genre
                                </label>
                                <input type="text" 
                                       class="form-control <?= isset($errors['genre']) ? 'is-invalid' : '' ?>" 
                                       id="genre" 
                                       name="genre" 
                                       value="<?= old('genre', $book['genre']) ?>" 
                                       placeholder="Enter genre (optional)">
                                <?php if (isset($errors['genre'])): ?>
                                    <div class="invalid-feedback"><?= $errors['genre'] ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Publication Year -->
                            <div class="mb-3">
                                <label for="publication_year" class="form-label">
                                    <i class="fas fa-calendar me-1"></i>Publication Year <span class="text-danger">*</span>
                                </label>
                                <input type="number" 
                                       class="form-control <?= isset($errors['publication_year']) ? 'is-invalid' : '' ?>" 
                                       id="publication_year" 
                                       name="publication_year" 
                                       value="<?= old('publication_year', $book['publication_year']) ?>" 
                                       placeholder="Enter publication year"
                                       min="1000" 
                                       max="<?= date('Y') ?>"
                                       required>
                                <?php if (isset($errors['publication_year'])): ?>
                                    <div class="invalid-feedback"><?= $errors['publication_year'] ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <!-- Book Cover Image -->
                            <div class="mb-3">
                                <label for="image" class="form-label">
                                    <i class="fas fa-image me-1"></i>Book Cover
                                </label>
                                <input type="file" 
                                       class="form-control <?= isset($errors['image']) ? 'is-invalid' : '' ?>" 
                                       id="image" 
                                       name="image" 
                                       accept="image/*"
                                       onchange="previewImage(this)">
                                <div class="form-text">
                                    <small>Upload JPG, PNG, or GIF (max 2MB). Leave empty to keep current image.</small>
                                </div>
                                <?php if (isset($errors['image'])): ?>
                                    <div class="invalid-feedback"><?= $errors['image'] ?></div>
                                <?php endif; ?>
                            </div>
                            
                            <!-- Current/Preview Image -->
                            <div class="text-center">
                                <div id="image-preview">
                                    <?php if ($book['image_path']): ?>
                                        <img src="<?= base_url($book['image_path']) ?>" 
                                             alt="<?= esc($book['title']) ?>" 
                                             class="book-image-large">
                                    <?php else: ?>
                                        <div class="book-image-large default-book-image default-book-image-large">
                                            <i class="fas fa-book"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <small class="text-muted d-block mt-2">Current Cover</small>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">
                        <a href="<?= base_url('books') ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Update Book
                        </button>
                    </div>

                <?= form_close() ?>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-info-circle me-1"></i>Book Information</h5>
            </div>
            <div class="card-body">
                <p><strong>Created:</strong><br>
                <small class="text-muted"><?= date('M j, Y g:i A', strtotime($book['created_at'])) ?></small></p>
                
                <?php if ($book['updated_at'] !== $book['created_at']): ?>
                <p><strong>Last Updated:</strong><br>
                <small class="text-muted"><?= date('M j, Y g:i A', strtotime($book['updated_at'])) ?></small></p>
                <?php endif; ?>
                
                <hr>
                
                <div class="alert alert-warning">
                    <small><i class="fas fa-exclamation-triangle me-1"></i>
                    <strong>Note:</strong> If you upload a new cover image, it will replace the current one permanently.</small>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
