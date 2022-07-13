<?php 

namespace Controllers;

interface iCRUD
{
    /**
     * Display the form so that we can create 
     */
    public function create();

    public function store(); // Traitement du formulaire et engirestement bdd

    public function modify($id);

    public function update($id);

    public function show($id);

    public function all();



}