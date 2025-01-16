<?php
/**
 * Modal Component
 *
 * @param string $modalId The unique ID for the modal.
 * @param string $modalTitle The title of the modal.
 * @param string $modalBodyFile The PHP file path for the modal body content.
 * @param string $modalFooter The footer content of the modal (optional).
 * @param string $error The error message to display (optional).
 */
function renderModal($modalId, $modalTitle, $modalBodyFile, $modalFooter = '', $error = '') {
    ?>
    <div class="modal fade" id="<?php echo htmlspecialchars($modalId); ?>" tabindex="-1" aria-labelledby="<?php echo htmlspecialchars($modalId . '-label'); ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <?php if (!empty($error)): ?>
                        <div class="alert alert-danger " style="color:red">
                            <?php echo htmlspecialchars($error); ?>
                        </div>
                    <?php endif; ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="<?php echo htmlspecialchars($modalId . '-label'); ?>">
                        <?php echo htmlspecialchars($modalTitle); ?> 
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
                    include $modalBodyFile;
                    ?>
                    <!-- Display error message if passed -->
                   
                </div>
                <?php if ($modalFooter): ?>
                    <div class="modal-footer">
                        <?php echo $modalFooter; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

        <script>
            <?php if ($error): ?>
                // Only show the modal if the flag is true

                window.onload = function() {
                    var myModal = new bootstrap.Modal(document.getElementById('<?php echo htmlspecialchars($modalId); ?>'));
                    myModal.show();
                }
                var closeButton = document.querySelector('#addModal .btn-close');
                                closeButton.addEventListener('click', function() {
                                    window.location.href = '/admin?page=user';
                                });
            <?php endif; ?>
        </script>
        <?php
}

// Call the modal rendering function in your script
renderModal('AddModal', 'User Registration', 'adduser.php', '', $error=$error ?? null  );
?>
