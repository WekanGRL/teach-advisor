<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230306090014 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lesson (id INT AUTO_INCREMENT NOT NULL, room_id INT NOT NULL, subject_id INT NOT NULL, teacher_id INT NOT NULL, start_date_time DATETIME NOT NULL, end_date_time DATETIME NOT NULL, type VARCHAR(10) NOT NULL, INDEX IDX_F87474F354177093 (room_id), INDEX IDX_F87474F323EDC87 (subject_id), INDEX IDX_F87474F341807E1D (teacher_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room (id INT AUTO_INCREMENT NOT NULL, number VARCHAR(15) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F354177093 FOREIGN KEY (room_id) REFERENCES room (id)');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F323EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id)');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F341807E1D FOREIGN KEY (teacher_id) REFERENCES teacher (id)');
        $this->addSql('ALTER TABLE review RENAME INDEX idx_794381c67d2d84d5 TO IDX_794381C641807E1D');
        $this->addSql('ALTER TABLE teacher RENAME INDEX uniq_790dd7e3e7927c74 TO UNIQ_B0F6A6D5E7927C74');
        $this->addSql('ALTER TABLE teacher_subject RENAME INDEX idx_a4e1512e7d2d84d5 TO IDX_360CB33B41807E1D');
        $this->addSql('ALTER TABLE teacher_subject RENAME INDEX idx_a4e1512e23edc87 TO IDX_360CB33B23EDC87');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lesson DROP FOREIGN KEY FK_F87474F354177093');
        $this->addSql('ALTER TABLE lesson DROP FOREIGN KEY FK_F87474F323EDC87');
        $this->addSql('ALTER TABLE lesson DROP FOREIGN KEY FK_F87474F341807E1D');
        $this->addSql('DROP TABLE lesson');
        $this->addSql('DROP TABLE room');
        $this->addSql('ALTER TABLE review RENAME INDEX idx_794381c641807e1d TO IDX_794381C67D2D84D5');
        $this->addSql('ALTER TABLE teacher RENAME INDEX uniq_b0f6a6d5e7927c74 TO UNIQ_790DD7E3E7927C74');
        $this->addSql('ALTER TABLE teacher_subject RENAME INDEX idx_360cb33b23edc87 TO IDX_A4E1512E23EDC87');
        $this->addSql('ALTER TABLE teacher_subject RENAME INDEX idx_360cb33b41807e1d TO IDX_A4E1512E7D2D84D5');
    }
}
