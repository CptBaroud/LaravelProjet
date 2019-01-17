@extends('template')

@section('content')
    LE SHOP
    <div id="contenu">

        <div id="wrapper"><h1> Requêtes administrateur</h1></div>
        <div id="barre_boutons_admin">
            
            <a href="admin.php?action=add">
            <div class="bouton_admin">
            Ajouter un article </div>
            </a>
            
            <a href="admin.php?action=del">
            <div class="bouton_admin">
            Supprimer un article </div>
            </a>
        </div>
<?php
@endsection