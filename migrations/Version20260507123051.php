<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260507123051 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__client AS SELECT id, name, email, phone, address, siret, rib FROM client');
        $this->addSql('DROP TABLE client');
        $this->addSql('CREATE TABLE client (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, siret VARCHAR(255) NOT NULL, rib VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO client (id, name, email, phone, address, siret, rib) SELECT id, name, email, phone, address, siret, rib FROM __temp__client');
        $this->addSql('DROP TABLE __temp__client');
        $this->addSql('CREATE TEMPORARY TABLE __temp__product AS SELECT id, name, invoice_id, description, price, unit_enum FROM product');
        $this->addSql('DROP TABLE product');
        $this->addSql('CREATE TABLE product (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, invoice_id INTEGER NOT NULL, description VARCHAR(255) NOT NULL, price NUMERIC(10, 0) NOT NULL, unit_enum VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO product (id, name, invoice_id, description, price, unit_enum) SELECT id, name, invoice_id, description, price, unit_enum FROM __temp__product');
        $this->addSql('DROP TABLE __temp__product');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client ADD COLUMN user_id INTEGER NOT NULL');
        $this->addSql('ALTER TABLE product ADD COLUMN user_id INTEGER NOT NULL');
    }
}
