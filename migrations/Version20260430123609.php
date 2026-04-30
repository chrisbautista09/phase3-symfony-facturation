<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260430123609 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, email, last_name, password, company_name, iban FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, last_name VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, company_name VARCHAR(255) NOT NULL, iban VARCHAR(34) DEFAULT NULL, roles CLOB NOT NULL, first_name VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO user (id, email, last_name, password, company_name, iban) SELECT id, email, last_name, password, company_name, iban FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, email, password, first_name, last_name, company_name, iban FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, firt_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, company_name VARCHAR(255) NOT NULL, iban VARCHAR(255) NOT NULL, siret VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO user (id, email, password, firt_name, last_name, company_name, iban) SELECT id, email, password, first_name, last_name, company_name, iban FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
    }
}
