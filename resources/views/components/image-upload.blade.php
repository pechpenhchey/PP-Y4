<div class="form-group">
    <label for="image">Upload Image</label>
    <input type="file" name="image" class="form-control" accept="image/*" id="image" onchange="previewImage()">
    
    <small class="form-text text-muted">
        Only files of type jpeg, png, jpg, gif are allowed, and the maximum size is 2MB.
    </small>
    
    @error('image')
        <span class="text-danger">{{ $message }}</span>
    @enderror

    <div id="imagePreview" class="mt-2" style="display:none;">
        <img id="previewImage" src="#" alt="Image Preview" class="img-fluid" />
    </div>
</div>

<script>
    window.onload = function () {
        function previewImage() {
            const fileInput = document.getElementById('image');
            const preview = document.getElementById('previewImage');
            const previewContainer = document.getElementById('imagePreview');
            
            const file = fileInput.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.style.display = 'block';
                };

                reader.onerror = function() {
                    alert("Error reading file.");
                    previewContainer.style.display = 'none';
                };

                reader.readAsDataURL(file);
            } else {
                previewContainer.style.display = 'none';
            }
        }
        document.getElementById('image').addEventListener('change', previewImage);
    };
</script>
