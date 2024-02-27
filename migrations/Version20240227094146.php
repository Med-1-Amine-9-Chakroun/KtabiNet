node_modules/<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240227094146 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE commande_livre');
        $this->addSql('ALTER TABLE `admin` ADD nom VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE commande ADD prix_total NUMERIC(10, 0) NOT NULL, ADD nbre_livres INT NOT NULL, ADD etat VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande_livre (id INT AUTO_INCREMENT NOT NULL, id_livre INT NOT NULL, id_commande INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE `admin` DROP nom');
        $this->addSql('ALTER TABLE commande DROP prix_total, DROP nbre_livres, DROP etat');
    }
}
