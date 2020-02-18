<form id="testform">
   <fieldset id="input1" class="clonedInput">
      <label>Name</label>
      <input type="text" name="name1" id="name1" />
   </fieldset>
   <fieldset>
      <label>Need more fields?</label>
      <input type="button" id="btnAdd" value="+" />
      <input type="button" id="btnDel" value="-" />
   </fieldset>
</form>

@push('crud_fields_scripts')
<script>

$(document).ready(function() {
  $('#btnDel').attr('disabled','disabled');
  $('#btnAdd').click(function() {
    var num = $('.clonedInput').length; // how many "duplicatable" input fields we currently have
    var newNum = new Number(num + 1); // the numeric ID of the new input field being added

    // create the new element via clone(), and manipulate it's ID using newNum value
    var newElem = $('#input' + num).clone().attr('id', 'Add' + newNum);

    // manipulate the name/id values of the input inside the new element
    newElem.children(':last').attr('id', 'name' + newNum).attr('name', 'name' + newNum);

    // insert the new element after the last "duplicatable" input field
    $('#input' + num).after(newElem);

    // enable the "remove" button
    $('#btnDel').attr('disabled',false);

    // business rule: you can only add 10 names
    if (newNum == 10)
      $('#btnAdd').attr('disabled','disabled');
  });

  $('#btnDel').click(function() {
    var num = $('.clonedInput').length; // how many "duplicatable" input fields we currently have
    $('#input' + num).remove(); // remove the last element

    // enable the "add" button
    $('#btnAdd').attr('disabled',false);

    // if only one element remains, disable the "remove" button
    if (num-1 == 1)
      $('#btnDel').attr('disabled','disabled');
  });

});

    </script>
@endpush
