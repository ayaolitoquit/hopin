
document.getElementById('uploadForm').addEventListener('submit', function(event) {
  event.preventDefault(); // Prevent form submission

  var fileInput = document.getElementById('fileInput');
  var file = fileInput.files[0];

  if (file) {
    var formData = new FormData(document.getElementById('uploadForm'));

    fetch('applicantsnew.php', {
      method: 'POST',
      body: formData
    })
    .then(function(response) {
      // Handle the response if needed
      console.log('File uploaded successfully!');
    })
    .catch(function(error) {
      // Handle any error that occurred during the request
      console.error('Error uploading file:', error);
    });
  }
});

function redirectToPage(url) {
  window.location.href = url;
}

// Redirect to page for the last .tablink td
$('td.tablink:not(:last-child)').on('click', function() {
  var rowId = $(this).closest('tr').data('id');
  redirectToPage('applicprofile.php?id=' + rowId);
});

// Edit link click event for the last .tablink td
$('td.tablink:last-child a.edit').on('click', function(e) {
  e.preventDefault();
  var rowId = $(this).closest('tr').data('id');
  redirectToPage('edit.php?id=' + rowId);
});

// Delete link click event for the last .tablink td
$('td.tablink:last-child a.delete').on('click', function(e) {
  e.preventDefault();
  var rowId = $(this).closest('tr').data('id');
  if (confirm('Are you sure you want to delete this record?')) {
    redirectToPage('delete.php?id=' + rowId);
  }
});



