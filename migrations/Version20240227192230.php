<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240227192230 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, id_client_id INT DEFAULT NULL, date_commande DATE NOT NULL, prix_total NUMERIC(10, 0) NOT NULL, nbre_livres INT NOT NULL, etat VARCHAR(255) NOT NULL, INDEX IDX_6EEAA67D99DED506 (id_client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D99DED506 FOREIGN KEY (id_client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE client DROP adresse_email');
        $this->addSql('ALTER TABLE commentaire ADD id_livre_reel_id INT DEFAULT NULL, ADD id_livre_pdf_id INT DEFAULT NULL, DROP id_livre');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC74DBB900 FOREIGN KEY (id_livre_reel_id) REFERENCES livre_reel (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCD69C7B95 FOREIGN KEY (id_livre_pdf_id) REFERENCES livre_pdf (id)');
        $this->addSql('CREATE INDEX IDX_67F068BC74DBB900 ON commentaire (id_livre_reel_id)');
        $this->addSql('CREATE INDEX IDX_67F068BCD69C7B95 ON commentaire (id_livre_pdf_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D99DED506');
        $this->addSql('DROP TABLE commande');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC74DBB900');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCD69C7B95');
        $this->addSql('DROP INDEX IDX_67F068BC74DBB900 ON commentaire');
        $this->addSql('DROP INDEX IDX_67F068BCD69C7B95 ON commentaire');
        $this->addSql('ALTER TABLE commentaire ADD id_livre INT NOT NULL, DROP id_livre_reel_id, DROP id_livre_pdf_id');
        $this->addSql('ALTER TABLE client ADD adresse_email VARCHAR(255) NOT NULL');
    }
}
