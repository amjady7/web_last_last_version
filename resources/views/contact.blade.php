@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-white">
                    <h2 class="text-center mb-0">Contact Us</h2>
                </div>
                <div class="card-body">
                    <div id="success-message" class="alert alert-success d-none">
                        Your message has been sent successfully!
                    </div>
                    
                    <div id="error-message" class="alert alert-danger d-none">
                        There was an error sending your message. Please try again.
                    </div>

                    <form id="contact-form">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" class="form-control" id="subject" name="subject" required>
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary" id="submit-btn">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- EmailJS Script -->
<script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
<script>
    (function() {
        // Initialize EmailJS with your public key
        emailjs.init("inP0ScI9yGNYY-BZq");
        
        document.getElementById('contact-form').addEventListener('submit', function(event) {
            event.preventDefault();
            
            // Show loading state
            const submitBtn = document.getElementById('submit-btn');
            const originalBtnText = submitBtn.innerHTML;
            submitBtn.innerHTML = 'Sending...';
            submitBtn.disabled = true;
            
            // Hide any previous messages
            document.getElementById('success-message').classList.add('d-none');
            document.getElementById('error-message').classList.add('d-none');
            
            // Get form data
            const formData = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                subject: document.getElementById('subject').value,
                message: document.getElementById('message').value
            };
            
            // Send email using EmailJS
            emailjs.send('service_v0rdo8j', 'template_1bjjrd3', formData)
                .then(function() {
                    // Show success message
                    document.getElementById('success-message').classList.remove('d-none');
                    // Reset form
                    document.getElementById('contact-form').reset();
                })
                .catch(function(error) {
                    // Show error message
                    document.getElementById('error-message').classList.remove('d-none');
                    console.error('Error:', error);
                })
                .finally(function() {
                    // Reset button state
                    submitBtn.innerHTML = originalBtnText;
                    submitBtn.disabled = false;
                });
        });
    })();
</script>
@endsection 