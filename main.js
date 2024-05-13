$(document).ready(function () {
  var trialCount = 1; // Trial counter
  var inputGroups; // Variable to store inputGroups data

  // Load inputGroups from JSON file
  $.getJSON("inputGroups.json", function (data) {
    inputGroups = data;
    console.log(inputGroups); // Log the loaded data for testing

    // Event binding for dynamically added elements
    bindEvents();
  }).fail(function (jqXHR, textStatus, errorThrown) {
    console.error("Error loading inputGroups:", textStatus, errorThrown);
  });

  // Function to bind events for dynamically added elements
  function bindEvents() {
    // Function to add another form
    $("#add-trial").click(function () {
      var trialHtml = '<div class="trial">';
      trialHtml +=
        '<div class="card-header trial-header">Trial ' + trialCount + "</div>";
      trialHtml += '<div class="card-body">';

      // Add each input group to the form
      inputGroups.forEach(function (group, index) {
        trialHtml += '<div class="form-group">';
        trialHtml +=
          '<label for="' + group.name + '">' + group.label + "</label>";
        trialHtml +=
          '<input type="' +
          group.type +
          '" class="form-control" name="' +
          group.name +
          '[]">';
        trialHtml += "</div>";
      });

      trialHtml +=
        '<button type="button" class="btn btn-danger remove-trial">Remove Trial</button>';
      trialHtml += "</div>";
      trialHtml += "</div>";

      $("#trial-container").append(trialHtml);
      trialCount++; // Increment the trial counter
    });

    // Function to remove a form
    $(document).on("click", ".remove-trial", function () {
      $(this).closest(".trial").remove();
      trialCount--; // Decrement the trial counter
    });

    // Function to submit the form and send data to the server
    $("#experiment-form").submit(function (event) {
      event.preventDefault(); // Prevent default form submission

      var formData = $(this).serialize(); // Serialize form data

      // Send form data to the server using AJAX
      $.ajax({
        type: "POST",
        url: "./process_form.php", // Change this to the path of your PHP script
        data: formData,
        success: function (response) {
          // Handle the server response
          console.log(response); // Log the server response for testing
        },
        error: function (xhr, status, error) {
          // Handle errors
          console.error(xhr.responseText); // Log error message
        },
      });
    });
  }
});
