/* $(document).ready(function () {
  var trialCount = 1; // Trial counter
  var inputGroups; // Variable to store inputGroups data

  // Load inputGroups from JSON file
  $.getJSON("inputGroups.json", function (data) {
    inputGroups = data;
    console.log(inputGroups); // Log the loaded data for testing
  });

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
  
  // Function to submit the form and generate the text file
  $("form").submit(function (event) {
    event.preventDefault(); // Prevent default form submission

    var filename = $("#filename").val().trim();
    var content = "Experimental Setup\n\n";

    // Collect data from each trial
    $(".trial").each(function () {
      var trialHeader = $(this).find(".card-header").text().trim();
      var inputs = $(this).find(".form-control");

      content += trialHeader + "\n";

      // Add content from each input group to the text
      inputs.each(function () {
        var label = $(this).prev("label").text();
        var value = $(this).val().trim();
        content += label + ": " + value + "\n";
      });

      content += "\n";
    });

    // Create and download the text file
    var element = document.createElement("a");
    element.setAttribute(
      "href",
      "data:text/plain;charset=utf-8," + encodeURIComponent(content)
    );
    element.setAttribute("download", filename + ".txt");
    element.style.display = "none";
    document.body.appendChild(element);
    element.click();
    document.body.removeChild(element);
  }); 
}); */

$(document).ready(function () {
  var trialCount = 1; // Trial counter
  var inputGroups; // Variable to store inputGroups data

  // Load inputGroups from JSON file
  $.getJSON("inputGroups.json", function (data) {
    inputGroups = data;
    console.log(inputGroups); // Log the loaded data for testing
  });

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
  $("form").submit(function (event) {
    event.preventDefault(); // Prevent default form submission

    var filename = $("#filename").val().trim();
    var content = "Experimental Setup\n\n";

    // Collect data from each trial
    $(".trial").each(function () {
      var trialHeader = $(this).find(".card-header").text().trim();
      var inputs = $(this).find(".form-control");

      content += trialHeader + "\n";

      // Add content from each input group to the text
      inputs.each(function () {
        var label = $(this).prev("label").text();
        var value = $(this).val().trim();
        content += label + ": " + value + "\n";
      });

      content += "\n";
    });

    // Send data to the server using AJAX
    $.ajax({
      type: "POST",
      url: "http://localhost/hvs_image_phpwfd/text_files", // Change this to the path of your PHP script
      data: { filename: filename, content: content },
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
});
