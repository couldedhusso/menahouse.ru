// // var photo_counter = 0;
// Dropzone.options.realDropzone = {
//
//     uploadMultiple: true,
//     parallelUploads: 10,
//     maxFilesize: 8,
//     previewsContainer: '#dropzonePreview',
//     // previewTemplate: document.querySelector('#preview-template').innerHTML,
//     // addRemoveLinks: true,
//     // dictRemoveFile: 'Remove',
//     dictFileTooBig: 'Image is bigger than 8MB',
//     autoProcessQueue: false,
//
//     // init: function() {
//     //  var submitButton = document.querySelector("#submit-all")
//     //      realDropzone = this; // closure
//     //
//     //  submitButton.addEventListener("click", function() {
//     //    realDropzone.processQueue(); // Tell Dropzone to process all queued files.
//     //  });
//
//
//     // The setting up of the dropzone
//     // init:function() {
//     //
//     //     this.on("removedfile", function(file) {
//     //
//     //         $.ajax({
//     //             type: 'POST',
//     //             url: 'upload/delete',
//     //             data: {id: file.name},
//     //             dataType: 'html',
//     //             success: function(data){
//     //                 var rep = JSON.parse(data);
//     //                 if(rep.code == 200)
//     //                 {
//     //                   //  photo_counter--;
//     //                   //  $("#photoCounter").text( "(" + photo_counter + ")");
//     //                 }
//     //
//     //             }
//     //         });
//     //
//     //     } );
//     // },
//     // error: function(file, response) {
//     //     // if($.type(response) === "string")
//     //     //     var message = response; //dropzone sends it's own error messages in string
//     //     // else
//     //     //     var message = response.message;
//     //     // file.previewElement.classList.add("dz-error");
//     //     // _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
//     //     // _results = [];
//     //     // for (_i = 0, _len = _ref.length; _i < _len; _i++) {
//     //     //     node = _ref[_i];
//     //     //     _results.push(node.textContent = message);
//     //     // }
//     //     // return _results;
//     // },
//     // success: function(file,done) {
//     //     //photo_counter++;
//     //     //$("#photoCounter").text( "(" + photo_counter + ")");
//     // }
// }


Dropzone.options.realDropzone = {

  url: "{{ url('/additem') }}",
  paramName: "files",
  uploadMultiple: false,
  parallelUploads: 10,
  maxFilesize: 10,
  previewsContainer: '#dropzonePreview',
  // previewTemplate: document.querySelector('#preview-template').innerHTML,
  // addRemoveLinks: true,
  // dictRemoveFile: 'Remove',
  dictFileTooBig: 'Image is bigger than 8MB',
  autoProcessQueue: false,

  // Prevents Dropzone from uploading dropped files immediately
  // autoProcessQueue: true,

  init: function() {
    // var submitButton = document.querySelector("#submit-all")
    //     realDropzone = this; // closure
    //
    // submitButton.addEventListener("click", function() {
    //   realDropzone.processQueue(); // Tell Dropzone to process all queued files.
    // var myDropzone = this;

    var myDropzone = Dropzone.forElement(#real-dropzone);

    // First change the button to actually tell Dropzone to process the queue.
    this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
      // Make sure that the form isn't actually being sent.
          e.preventDefault();
          e.stopPropagation();

          for (var i = 0; i < myDropzone.files.length; i++ ){
              myDropzone.filesQueue.push(myDropzone.files[i]);
          }
          myDropzone.processQueue();

    });

    // // You might want to show the submit button only when
    // // files are dropped here:
    // this.on("addedfile", function() {
    //   // Show submit button here and/or inform user to click it.
    // });

  }
};
