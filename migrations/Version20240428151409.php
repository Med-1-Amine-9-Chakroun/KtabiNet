<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240428151409 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE acces (id INT AUTO_INCREMENT NOT NULL, id_client_id INT DEFAULT NULL, id_livre_pdf_id INT DEFAULT NULL, date DATE NOT NULL, acces TINYINT(1) NOT NULL, INDEX IDX_D0F43B1099DED506 (id_client_id), INDEX IDX_D0F43B10D69C7B95 (id_livre_pdf_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom_client VARCHAR(255) NOT NULL, prenom_client VARCHAR(255) NOT NULL, num_tel VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_C7440455E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, id_client_id INT DEFAULT NULL, date_commande DATE NOT NULL, prix_total NUMERIC(10, 0) NOT NULL, nbre_livres INT NOT NULL, etat VARCHAR(255) NOT NULL, INDEX IDX_6EEAA67D99DED506 (id_client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, id_client_id INT DEFAULT NULL, id_livre_reel_id INT DEFAULT NULL, id_livre_pdf_id INT DEFAULT NULL, contenue VARCHAR(15000) DEFAULT NULL, date DATETIME NOT NULL, evaluation DOUBLE PRECISION DEFAULT NULL, INDEX IDX_67F068BC99DED506 (id_client_id), INDEX IDX_67F068BC74DBB900 (id_livre_reel_id), INDEX IDX_67F068BCD69C7B95 (id_livre_pdf_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, full_name VARCHAR(50) DEFAULT NULL, email VARCHAR(180) NOT NULL, sujet VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, create_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE conversation (id INT AUTO_INCREMENT NOT NULL, id_client_id INT DEFAULT NULL, date_heure DATETIME NOT NULL, INDEX IDX_8A8E26E999DED506 (id_client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livre_pdf (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, auteur VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, description VARCHAR(2500) NOT NULL, categorie VARCHAR(255) NOT NULL, nbr_page INT NOT NULL, solde DOUBLE PRECISION NOT NULL, date_publication DATE NOT NULL, langue VARCHAR(255) NOT NULL, url_pdf VARCHAR(255) NOT NULL, url_image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livre_reel (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, auteur VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, description VARCHAR(2500) NOT NULL, categorie VARCHAR(255) NOT NULL, nbr_page INT NOT NULL, solde DOUBLE PRECISION NOT NULL, date_publication DATE NOT NULL, langue VARCHAR(255) NOT NULL, stock INT NOT NULL, image_url VARCHAR(255) NOT NULL, INDEX IDX_F887F7DC12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, id_conversation_id INT DEFAULT NULL, contenue VARCHAR(6000) NOT NULL, type VARCHAR(20) NOT NULL, date_heure DATETIME NOT NULL, INDEX IDX_B6BD307FE0F2C01E (id_conversation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE traducteur (id INT AUTO_INCREMENT NOT NULL, langue_source VARCHAR(255) NOT NULL, langue_destionation VARCHAR(255) NOT NULL, nom_complet_traducteur VARCHAR(255) NOT NULL, pays_traducteur VARCHAR(255) NOT NULL, id_livre INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE acces ADD CONSTRAINT FK_D0F43B1099DED506 FOREIGN KEY (id_client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE acces ADD CONSTRAINT FK_D0F43B10D69C7B95 FOREIGN KEY (id_livre_pdf_id) REFERENCES livre_pdf (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D99DED506 FOREIGN KEY (id_client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC99DED506 FOREIGN KEY (id_client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC74DBB900 FOREIGN KEY (id_livre_reel_id) REFERENCES livre_reel (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCD69C7B95 FOREIGN KEY (id_livre_pdf_id) REFERENCES livre_pdf (id)');
        $this->addSql('ALTER TABLE conversation ADD CONSTRAINT FK_8A8E26E999DED506 FOREIGN KEY (id_client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE livre_reel ADD CONSTRAINT FK_F887F7DC12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FE0F2C01E FOREIGN KEY (id_conversation_id) REFERENCES conversation (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE acces DROP FOREIGN KEY FK_D0F43B1099DED506');
        $this->addSql('ALTER TABLE acces DROP FOREIGN KEY FK_D0F43B10D69C7B95');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D99DED506');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC99DED506');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC74DBB900');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCD69C7B95');
        $this->addSql('ALTER TABLE conversation DROP FOREIGN KEY FK_8A8E26E999DED506');
        $this->addSql('ALTER TABLE livre_reel DROP FOREIGN KEY FK_F887F7DC12469DE2');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FE0F2C01E');
        $this->addSql('DROP TABLE acces');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE conversation');
        $this->addSql('DROP TABLE livre_pdf');
        $this->addSql('DROP TABLE livre_reel');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE traducteur');
    }
}
