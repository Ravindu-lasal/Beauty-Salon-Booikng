  document.querySelectorAll('a[href="#"], a[href=" "], a[href^="javascript:"]').forEach(link => {
    link.addEventListener('click', (e) => {
      e.preventDefault(); // Stop default behavior
      window.location.href = './404.html'; // Redirect to your 404 page
    });
  });
