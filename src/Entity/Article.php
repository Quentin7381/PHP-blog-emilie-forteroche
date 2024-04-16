<?php

namespace Entity;
use DateTime;

/**
 * Entité Article, un article est défini par les champs
 * id, id_user, title, content, date_creation, date_update
 */
 class Article extends AbstractEntity
 {
    protected int $idUser;
    protected int $views = 0;
    protected string $title = "";
    protected string $content = "";
    protected ?DateTime $dateCreation = null;
    protected ?DateTime $dateUpdate = null;

    /**
     * Getter pour le contenu.
     * Retourne les $length premiers caractères du contenu.
     * @param int $length : le nombre de caractères à retourner.
     * Si $length n'est pas défini (ou vaut -1), on retourne tout le contenu.
     * Si le contenu est plus grand que $length, on retourne les $length premiers caractères avec "..." à la fin.
     * @return string
     */
    public function getContent(int $length = -1) : string
    {
        if ($length > 0) {
            // Ici, on utilise mb_substr et pas substr pour éviter de couper un caractère en deux (caractère multibyte comme les accents).
            $content = mb_substr($this->content, 0, $length);
            if (strlen($this->content) > $length) {
                $content .= "...";
            }

            return $content;
        }
        return $this->content;
    }

    /**
     * Setter pour la date de création. Si la date est une string, on la convertit en DateTime.
     * @param string|DateTime $dateCreation
     * @param string $format : le format pour la convertion de la date si elle est une string.
     * Par défaut, c'est le format de date mysql qui est utilisé.
     */
    public function setDateCreation(string|DateTime $dateCreation, string $format = 'Y-m-d H:i:s') : void
    {
        if (is_string($dateCreation)) {
            $dateCreation = DateTime::createFromFormat($format, $dateCreation);
        }
        $this->dateCreation = $dateCreation;
    }

    /**
     * Setter pour la date de mise à jour. Si la date est une string, on la convertit en DateTime.
     * @param string|DateTime $dateUpdate
     * @param string $format : le format pour la convertion de la date si elle est une string.
     * Par défaut, c'est le format de date mysql qui est utilisé.
     */
    public function setDateUpdate(null|string|DateTime $dateUpdate, string $format = 'Y-m-d H:i:s') : void 
    {
        if (is_string($dateUpdate)) {
            $dateUpdate = DateTime::createFromFormat($format, $dateUpdate);
        }
        $this->dateUpdate = $dateUpdate;
    }
 }
