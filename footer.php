			<!-- footer -->
			<footer class="footer" role="contentinfo">

			

			</footer>
			<!-- /footer -->

		</div>
		<!-- /wrapper -->

		<?php wp_footer(); ?>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	</body>

<script type="text/javascript">

    function selectTodo() {
      $(this).toggleClass('select');
    }

    //supprimer
    function deleteSuccess (data, success){
      let selecteur = '#todo-'+data.ID;  
      let li = $(selecteur); 
      li.addClass('animate__animated animate__zoomOut ');
      li.on('animationend', function(){ 
        $(selecteur).remove();

      let alert =  $('#template-alert').clone();
      let valeur = li.text();
      alert.attr('id',"");
      let alertText = alert.find('.alert-text')
      alertText.text("suppression - " + valeur);
      $('#section-alert').append(alert);
      alert.show();   
      });
    }

    function clickDelete(){
      let post_id = $(this).attr('post_id');
      
      $.ajax({
        'url': '/?rest_route=/dswt/todo&MON_ID='+post_id,
        'method' : 'DELETE',
        'success' : deleteSuccess   
      });    
    }

  
    //
    function obtenirTodos(data, status){
      let todos = $('#listes');
      todos.addClass('animate__animated animate__lightSpeedInLeft ');

      $(data).each(function(position, todo){

        let li = $('<li class= "list-task"/>');
        let tache = $('<span />')
        tache.addClass('task');
        let btnCheck = $("<i class='fas fa-check'></i>")
        let btnSupprimer = $('<i class="fas fa-trash-alt"></i>')
        let btnEdit = $('<i class="fas fa-edit"></i>')
    
        btnSupprimer.click(clickDelete);
        btnSupprimer.attr('post_id',todo.ID);
        btnEdit.click(clickEdit);
        btnEdit.attr('post_id',todo.ID);
        li.attr('id','todo-'+todo.ID);
        tache.text(todo.post_title);
        li.append(tache);
        li.append(btnCheck);
        li.append(btnSupprimer);
        li.append(btnEdit);
        todos.append(li);
        li.addClass('animate__animated animate__lightSpeedInLeft '); 
      })  
    }

    //
    function nouveauTodo(data, status){
      let todos = $('#listes');
      todos.addClass('animate__animated animate__lightSpeedInLeft ');

      if (status == 'success'){
        
        let li = $('<li class= "list-task"/>');
        let tache = $('<span  />');
        tache.addClass('task');
        li.attr('id','todo-'+data.id);
        let btnCheck = $("<i class='fas fa-check'></i>");
        let btnSupprimer = $('<i class="fas fa-trash-alt"></i>');
        let btnEdit = $('<i class="fas fa-edit"></i>'); 
        
        btnSupprimer.attr('post_id',data.id);
        btnSupprimer.click(clickDelete);
        btnEdit.click(clickEdit);
        btnEdit.attr('post_id',data.id);
        li.append(tache);
        tache.text(data.titre);
        li.append(btnCheck);
        li.append(btnSupprimer);
        li.append(btnEdit);
        todos.append(li);
        li.addClass('animate__animated animate__lightSpeedInLeft ');
        $('#txt').val('');
      }
    }

    //modifier
    function TexteFocusOut(){
      let post_id = $(this).attr('post_id');
      let titre = $(this).val();
      modifierPost(post_id,titre);
    }

    function clickEdit(){
      let post_id = $(this).attr('post_id');
      let li= $(this).parent();
      let champTexte = li.find('.task');
      let texte = champTexte.text();
      champTexte.hide();
      
      let inputTexte = $('<input class = "inputEdit" type="text"/>');
      inputTexte.attr('post_id', post_id);
      inputTexte.val(texte);
      inputTexte.focusout(TexteFocusOut);
      li.append(inputTexte);
    }

    function modifierReponse(data){
      let selecteur = '#todo-'+data.id;
      let li = $(selecteur);
      let champTexte = li.find('.task');
      champTexte.text(data.titre);
      champTexte.show();

      let inputTexte = $('.inputEdit');
      inputTexte.remove();
    }
    
    function modifierPost(id, titre){
      
      $.ajax({
        'url': '/?rest_route=/dswt/todo',
        'method' : 'POST',
        'data' : {
        'titre': titre,
        'id': id
        },
        'success' : modifierReponse     
      });
    }
      
    $(document).ready(function(){
      $('.list-task').click(selectTodo);
   
      $.ajax({
        'url' : '/?rest_route=/dswt/todo',
        'method' : 'GET',
        'success' : obtenirTodos
      });

      $('#btnAdd').click(function(){  
      var addNewPost = $('#test').find('input[name="message"]').val();
       
      $.ajax({
        'url': '/?rest_route=/dswt/todo',
        'method' : 'POST',
        'data' : {'titre' : addNewPost},
        'success' : nouveauTodo 
      }); 
    });
  });
  
  

</script>
</html>
