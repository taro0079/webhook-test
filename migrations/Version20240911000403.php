<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240911000403 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE customer_customer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "order_order_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE customer (customer_id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(customer_id))');
        $this->addSql('CREATE TABLE line_customer (line_user_id VARCHAR(255) NOT NULL, customer_id INT DEFAULT NULL, nonce_nonce VARCHAR(255) NOT NULL, PRIMARY KEY(line_user_id))');
        $this->addSql('CREATE INDEX IDX_525ADE739395C3F3 ON line_customer (customer_id)');
        $this->addSql('CREATE TABLE "order" (order_id INT NOT NULL, payment_total INT NOT NULL, PRIMARY KEY(order_id))');
        $this->addSql('ALTER TABLE line_customer ADD CONSTRAINT FK_525ADE739395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (customer_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE customer_customer_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "order_order_id_seq" CASCADE');
        $this->addSql('ALTER TABLE line_customer DROP CONSTRAINT FK_525ADE739395C3F3');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE line_customer');
        $this->addSql('DROP TABLE "order"');
    }
}
