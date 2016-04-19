<?php

/**
 * Gestion du panier.
 * @author Flavien
 * 
 */
class Panier 
{
	/**
	 * @var unknown Liste panier.
	 */
	private $items;
	
	public function __construct() 
	{
		$items = array();
	}
	
	
	/** 
	 * Permet d'ajouter un produit au panier.
	 * @param unknown $idProduit Id du produit à ajouter.
	 */
	public function ajouterProduits($idProduit)
	{
		if(!in_array ($idProduit, $this->items))
		{
			$this->items[] = $idProduit;
		}
	}
}


?>