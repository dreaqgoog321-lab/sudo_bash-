// Typing effect for hero section
function typeWriter(element, text, speed = 100) {
    let i = 0;
    element.innerHTML = '';
    
    function type() {
        if (i < text.length) {
            element.innerHTML += text.charAt(i);
            i++;
            setTimeout(type, speed);
        } else {
            // Reset and repeat
            setTimeout(() => {
                element.style.borderRight = '3px solid #00ff41';
                setTimeout(() => typeWriter(element, text, speed), 2000);
            }, 3000);
        }
    }
    type();
}

// Initialize typing effect
document.addEventListener('DOMContentLoaded', function() {
    const typingElements = document.querySelectorAll('.typing-text');
    typingElements.forEach(el => {
        const texts = [
            'WELCOME TO ETHICAL HACKING',
            'SECURE YOUR DIGITAL FUTURE',
            'LEGAL CYBERSECURITY TRAINING',
            'PROTECT, DEFEND, EDUCATE'
        ];
        let index = 0;
        
        function cycleText() {
            typeWriter(el, texts[index], 80);
            index = (index + 1) % texts.length;
        }
        cycleText();
    });

    // Smooth scrolling
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // Navbar scroll effect
    window.addEventListener('scroll', () => {
        const header = document.querySelector('header');
        if (window.scrollY > 100) {
            header.style.background = 'rgba(0,0,0,0.98)';
            header.style.backdropFilter = 'blur(20px)';
        } else {
            header.style.background = 'rgba(0,0,0,0.95)';
            header.style.backdropFilter = 'blur(10px)';
        }
    });
});

// Form submission
function submitForm() {
    const form = document.getElementById('requestForm');
    const submitBtn = document.querySelector('button[type="submit"]');
    
    submitBtn.innerHTML = 'PROCESSING...';
    submitBtn.disabled = true;
    
    // Simulate processing
    setTimeout(() => {
        alert('FORM SUBMITTED SUCCESSFULLY!\n\nDATA SECURELY STORED.\nADMIN WILL REVIEW YOUR REQUEST.');
        form.reset();
        submitBtn.innerHTML = 'SUBMIT REQUEST';
        submitBtn.disabled = false;
    }, 2000);
}
