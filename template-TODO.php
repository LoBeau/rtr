<?php /* Template Name: todolist */ get_header(); ?>

<div class="section1">
  <div class="container" id="section-alert"></div>
      <h2>ToDoList</h2>
<div id="template-alert" class="alert alert-danger alert-dismissible fade show" role="alert" style="display:none">
  <p class="alert-text"></p> 
  <button id='btnINT' type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
  <div class="container">
  <div id = "test" class="input-group mb-3">
      <input type="text" id="txt"class="form-control" name="message"placeholder="Tâche">
      <input type="submit" class="btn btn-primary" id="btnAdd" value="ajouter"></input>
      </div>
      <div class="noncomplete col-10">
        <h3>Liste</h3>
        <ul id = "listes" class = "group-task" >
        </ul>
      </div>
  </div>
</div>

<?php get_footer(); ?>
