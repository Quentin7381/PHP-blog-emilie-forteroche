# Taches a realiser

## Modification du tableau articles admin

### Ajout d'informations

#### Nombre de vues

Réalisé sur BDD :
```sql
ALTER TABLE article
ADD vues INT NOT NULL DEFAULT 0;
```

```sql
UPDATE article
SET vues = 0;
```

Commit associé :
[BF-1] Plus d'informations sur la page admin

#### Nombre de commentaires

Commit associé :
[BF-1] Plus d'informations sur la page admin

#### Date de publication de l'article

Commit associé :
[BF-1] Plus d'informations sur la page admin

### Possibilite de tri

### Validite de la mise en forme

#### Adapte 1366px

#### Conforme au style actuel

## Fonctionnalite suppression commentaire