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
		$this->items = array();
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
	
	/**
	 * Supprime un produit du panier
	 * @param unknown $idProduit L'id du produit à supprimer
	 */
	public function supprimerProduit($idProduit)
	{
		$newItems = array();
		
		foreach($this->items as $item)
		{
			if($idProduit != $item)
			{
				$newItems[] = $item;
			}
		}
		
		$this->items = $newItems;
	}
	
	/**
	 * Récupère les produits du panier
	 * @return unknown Récupère le tableau des produits
	 * du panier
	 */
	public function recupereItems()
	{
		return $this->items;
	}
}


?>