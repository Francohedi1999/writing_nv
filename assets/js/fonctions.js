function get_menu( id ) 
{
  var div = document.getElementById( id );
  if( div.style.display == "none" )
  {
    div.style.display = "block";
  }
  else
  {
    div.style.display = "none";
  }  
}


function scroll_top(id)
{
  document.getElementById(id).scrollIntoView();
}


function open_form_motif( id ) 
{
  var div = document.getElementById( id );
  div.style.display = "block";
  scroll_top(id);
}


function open_form( id ) 
{
  var div = document.getElementById( id );
  div.style.display = "block";
}


function close_form_motif(id) 
{
  var div = document.getElementById( id );
  div.style.display = "none";
}