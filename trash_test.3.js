$(document).ready(function () {
  var trialCount = 1; // Trial counter
  var fieldCount = 1; // Field counter

  // Function to add another form
  $(".add-form").click(function () {
    var trialHtml = '<div class="trial">';
    trialHtml +=
      '<div class="card-header trial-header">Trial ' + trialCount + "</div>";
    trialHtml += '<div class="card-body">';

    // Array of objects to represent each input group
    var inputGroups = [
      { label: "Environment:", type: "text", name: "envname" },
      { label: "Maximum Time:", type: "time", name: "maxtime" },
      { label: "SET_SCENE:", type: "text", name: "setscene" },
      { label: "REMARKS:", type: "text", name: "remarks" },
      {
        label: "TRACKING_DIAMETER:",
        type: "float",
        name: "trackingdiameter",
      },
      {
        label: "TRACKING_AREA_NORTH:",
        type: "float",
        name: "trackingareanorth",
      },
      {
        label: "TRACKING_AREA_SOUTH:",
        type: "float",
        name: "trackingareasouth",
      },
      {
        label: "TRACKING_AREA_WEST:",
        type: "float",
        name: "trackingareawest",
      },
      {
        label: "TRACKING_AREA_EAST:",
        type: "float",
        name: "trackingareaeast",
      },
      { label: "PLAYER_SCALE:", type: "float", name: "playerscale" },
      {
        label: "CONTROL_TRANSFORM:",
        type: "text",
        name: "controltransform",
      },
      { label: "READ_OMNI:", type: "text", name: "readomni" },
      { label: "SMOOTH_MOTION:", type: "text", name: "smoothmotion" },
      { label: "OMNI_SENS:", type: "float", name: "omnisens" },
      { label: "OMNIDRIVE_INPUT:", type: "text", name: "omnidriveinput" },
      {
        label: "DEACTIVATE_NAVIGATION_KEYS:",
        type: "text",
        name: "deactivatenavigationkeys",
      },
      { label: "SPEED_MODIFIER:", type: "text", name: "speedmodifier" },
      {
        label: "DIRECTIONAL_ROTATION_SPEED:",
        type: "text",
        name: "directionalrotationspeed",
      },
      { label: "MAXIMUM_TIME:", type: "text", name: "maximutime" },
      { label: "TARGET_RADIUS:", type: "text", name: "targetradius" },
      { label: "TARGET_POSITION:", type: "text", name: "targetposition" },
      { label: "MOVE_OBJECT:", type: "text", name: "moveobject" },
      {
        label: "EEG_SHOW_DATA_SUMMARY_IN_HMD:",
        type: "text",
        name: "eegshowdatasummaryinhmd",
      },
      {
        label: "EEG_SHOW_DATA_IN_HMD:",
        type: "text",
        name: "eegshowdatainhmd",
      },
      { label: "FADE_IN_TIME:", type: "text", name: "fadeintime" },
      { label: "FADE_OUT_TIME:", type: "text", name: "fadeouttime" },
      {
        label: "PRE_TRIAL_START_POINT:",
        type: "text",
        name: "pretrialstartpoint",
      },
      {
        label: "TRIAL_START_POINT:",
        type: "text",
        name: "trialstartpoint",
      },
      { label: "MAIN_MP3:", type: "text", name: "mainmp3" },
      { label: "END_WITH_MP3:", type: "text", name: "endwithmp3" },
      { label: "STOP_INTERVAL:", type: "text", name: "stopinterval" },
      {
        label: "INTER_TRIAL_INTERVAL:",
        type: "text",
        name: "intertrialinterval",
      },
      {
        label: "REGULAR_END_TEXT:",
        type: "text",
        name: "regularendtext",
      },
      { label: "TIMED_END_TEXT:", type: "text", name: "timeendtext" },
      {
        label: "END_OF_SERIES_MESSAGE:",
        type: "text",
        name: "endofseriesmessage",
      },
      // Add more input groups as needed
    ];

    // Add each input group to the form
    inputGroups.forEach(function (group) {
      trialHtml += '<div class="form-group">';
      trialHtml +=
        '<label for="' +
        group.name +
        '">' +
        fieldCount +
        ". " +
        group.label +
        "</label>";
      trialHtml +=
        '<input type="' +
        group.type +
        '" class="form-control" name="' +
        group.name +
        "[]'" +
        '">';
      trialHtml += "</div>";
      fieldCount++;
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
  $("#send-form").click(function () {
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
});
