<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>
            <?php echo $titre ?> 
        </title>
    </head>
    <body>
        <div class="container">
        <h1><?php echo $titre ?></h1>
        <?php foreach($lesTodos as $todo): ?>
        <?php if ($todo['completed']==1){ ?>
        <strike><?php echo $todo['task']; ?></strike><a href= "<?php echo base_url('Todo/aFaire/'.$todo['id']) ?>"> Fait </a>
        <?php 
        } 
        else 
        {
            ?>
        <?php echo $todo['task']; ?> <a href= "<?php echo base_url('Todo/fait/'.$todo['id']) ?>"> a Faire </a> 
        <?php }
        ?>
        <a href =" <?php echo base_url('todo/modifier/'.$todo['id']); ?>"> Modifier </a>
        <a href =" <?php echo base_url('todo/delete/'.$todo['id']); ?>"> Supprimé </a><br>
        <?php endforeach ?>
        <a href =" <?php echo base_url('todo/add'); ?>"> Ajouter </a> <br>
        <a href =" <?php echo base_url('todo/reordonner'); ?>"> Réordonner les tâches </a> <br>
        
        </div>
        
    </body>
</html>
<?php



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
