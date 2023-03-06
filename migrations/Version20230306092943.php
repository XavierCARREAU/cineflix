<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230306092943 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE playlist (id INT AUTO_INCREMENT NOT NULL, created_by_id INT NOT NULL, name VARCHAR(255) NOT NULL, public TINYINT(1) NOT NULL, description LONGTEXT DEFAULT NULL, rating DOUBLE PRECISION DEFAULT NULL, movies_list LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', comments_list LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', INDEX IDX_D782112DB03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, profil_pic VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_playlist (users_id INT NOT NULL, playlist_id INT NOT NULL, INDEX IDX_ACC33AF767B3B43D (users_id), INDEX IDX_ACC33AF76BBD148 (playlist_id), PRIMARY KEY(users_id, playlist_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE watched_movie (id INT AUTO_INCREMENT NOT NULL, watched_by_id INT NOT NULL, movie_id INT NOT NULL, rating DOUBLE PRECISION DEFAULT NULL, comment LONGTEXT DEFAULT NULL, INDEX IDX_29C2D8FE9E7B0A95 (watched_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE playlist ADD CONSTRAINT FK_D782112DB03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE users_playlist ADD CONSTRAINT FK_ACC33AF767B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_playlist ADD CONSTRAINT FK_ACC33AF76BBD148 FOREIGN KEY (playlist_id) REFERENCES playlist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE watched_movie ADD CONSTRAINT FK_29C2D8FE9E7B0A95 FOREIGN KEY (watched_by_id) REFERENCES users (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE playlist DROP FOREIGN KEY FK_D782112DB03A8386');
        $this->addSql('ALTER TABLE users_playlist DROP FOREIGN KEY FK_ACC33AF767B3B43D');
        $this->addSql('ALTER TABLE users_playlist DROP FOREIGN KEY FK_ACC33AF76BBD148');
        $this->addSql('ALTER TABLE watched_movie DROP FOREIGN KEY FK_29C2D8FE9E7B0A95');
        $this->addSql('DROP TABLE playlist');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE users_playlist');
        $this->addSql('DROP TABLE watched_movie');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
