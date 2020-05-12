<?php require APPROOT .'/views/inc/footer.php'; ?>

<?php 
ob_start() 
?>


<?php 
$content =ob_get_clean();
$titre = $data['title'] ;
require APPROOT."/views/inc/template.html.php";
?>