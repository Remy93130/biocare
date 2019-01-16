<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190116213219 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE hospital_node (id INT AUTO_INCREMENT NOT NULL, responsible_id INT DEFAULT NULL, ancestor_node_id INT DEFAULT NULL, type_node_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_49E4204602AD315 (responsible_id), INDEX IDX_49E4204834EAE72 (ancestor_node_id), INDEX IDX_49E42046E2CF022 (type_node_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE acts (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, type_id INT NOT NULL, dmp_id INT NOT NULL, date_creation DATE NOT NULL, state TINYINT(1) NOT NULL, INDEX IDX_6A10A677F675F31B (author_id), INDEX IDX_6A10A677C54C8C93 (type_id), INDEX IDX_6A10A677B13AE3AD (dmp_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dmp (id INT AUTO_INCREMENT NOT NULL, node_managing_id INT DEFAULT NULL, surname VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, social_number BIGINT UNSIGNED NOT NULL, birth_date DATE DEFAULT NULL, birth_place VARCHAR(255) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, INDEX IDX_30C9DE387E10622A (node_managing_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE file (id INT AUTO_INCREMENT NOT NULL, act_id INT NOT NULL, file VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_8C9F3610D1A55B28 (act_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE history (id INT AUTO_INCREMENT NOT NULL, hospital_node_id INT DEFAULT NULL, date_e DATE NOT NULL, date_s DATE DEFAULT NULL, reason VARCHAR(255) NOT NULL, INDEX IDX_27BA704BB4B0FE2C (hospital_node_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE history_dmp (history_id INT NOT NULL, dmp_id INT NOT NULL, INDEX IDX_DE6683F71E058452 (history_id), INDEX IDX_DE6683F7B13AE3AD (dmp_id), PRIMARY KEY(history_id, dmp_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnal (id INT AUTO_INCREMENT NOT NULL, role_id INT DEFAULT NULL, hospital_node_id INT DEFAULT NULL, assignment_id INT DEFAULT NULL, surname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, INDEX IDX_C2D036DAD60322AC (role_id), INDEX IDX_C2D036DAB4B0FE2C (hospital_node_id), INDEX IDX_C2D036DAD19302F8 (assignment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnal_specialization (personnal_id INT NOT NULL, specialization_id INT NOT NULL, INDEX IDX_A3DA9D91E99036B5 (personnal_id), INDEX IDX_A3DA9D91FA846217 (specialization_id), PRIMARY KEY(personnal_id, specialization_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specialization (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_node (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, weight INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE hospital_node ADD CONSTRAINT FK_49E4204602AD315 FOREIGN KEY (responsible_id) REFERENCES personnal (id)');
        $this->addSql('ALTER TABLE hospital_node ADD CONSTRAINT FK_49E4204834EAE72 FOREIGN KEY (ancestor_node_id) REFERENCES hospital_node (id)');
        $this->addSql('ALTER TABLE hospital_node ADD CONSTRAINT FK_49E42046E2CF022 FOREIGN KEY (type_node_id) REFERENCES type_node (id)');
        $this->addSql('ALTER TABLE acts ADD CONSTRAINT FK_6A10A677F675F31B FOREIGN KEY (author_id) REFERENCES personnal (id)');
        $this->addSql('ALTER TABLE acts ADD CONSTRAINT FK_6A10A677C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE acts ADD CONSTRAINT FK_6A10A677B13AE3AD FOREIGN KEY (dmp_id) REFERENCES dmp (id)');
        $this->addSql('ALTER TABLE dmp ADD CONSTRAINT FK_30C9DE387E10622A FOREIGN KEY (node_managing_id) REFERENCES hospital_node (id)');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F3610D1A55B28 FOREIGN KEY (act_id) REFERENCES acts (id)');
        $this->addSql('ALTER TABLE history ADD CONSTRAINT FK_27BA704BB4B0FE2C FOREIGN KEY (hospital_node_id) REFERENCES hospital_node (id)');
        $this->addSql('ALTER TABLE history_dmp ADD CONSTRAINT FK_DE6683F71E058452 FOREIGN KEY (history_id) REFERENCES history (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE history_dmp ADD CONSTRAINT FK_DE6683F7B13AE3AD FOREIGN KEY (dmp_id) REFERENCES dmp (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personnal ADD CONSTRAINT FK_C2D036DAD60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('ALTER TABLE personnal ADD CONSTRAINT FK_C2D036DAB4B0FE2C FOREIGN KEY (hospital_node_id) REFERENCES hospital_node (id)');
        $this->addSql('ALTER TABLE personnal ADD CONSTRAINT FK_C2D036DAD19302F8 FOREIGN KEY (assignment_id) REFERENCES hospital_node (id)');
        $this->addSql('ALTER TABLE personnal_specialization ADD CONSTRAINT FK_A3DA9D91E99036B5 FOREIGN KEY (personnal_id) REFERENCES personnal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personnal_specialization ADD CONSTRAINT FK_A3DA9D91FA846217 FOREIGN KEY (specialization_id) REFERENCES specialization (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE hospital_node DROP FOREIGN KEY FK_49E4204834EAE72');
        $this->addSql('ALTER TABLE dmp DROP FOREIGN KEY FK_30C9DE387E10622A');
        $this->addSql('ALTER TABLE history DROP FOREIGN KEY FK_27BA704BB4B0FE2C');
        $this->addSql('ALTER TABLE personnal DROP FOREIGN KEY FK_C2D036DAB4B0FE2C');
        $this->addSql('ALTER TABLE personnal DROP FOREIGN KEY FK_C2D036DAD19302F8');
        $this->addSql('ALTER TABLE file DROP FOREIGN KEY FK_8C9F3610D1A55B28');
        $this->addSql('ALTER TABLE acts DROP FOREIGN KEY FK_6A10A677B13AE3AD');
        $this->addSql('ALTER TABLE history_dmp DROP FOREIGN KEY FK_DE6683F7B13AE3AD');
        $this->addSql('ALTER TABLE history_dmp DROP FOREIGN KEY FK_DE6683F71E058452');
        $this->addSql('ALTER TABLE hospital_node DROP FOREIGN KEY FK_49E4204602AD315');
        $this->addSql('ALTER TABLE acts DROP FOREIGN KEY FK_6A10A677F675F31B');
        $this->addSql('ALTER TABLE personnal_specialization DROP FOREIGN KEY FK_A3DA9D91E99036B5');
        $this->addSql('ALTER TABLE personnal DROP FOREIGN KEY FK_C2D036DAD60322AC');
        $this->addSql('ALTER TABLE personnal_specialization DROP FOREIGN KEY FK_A3DA9D91FA846217');
        $this->addSql('ALTER TABLE acts DROP FOREIGN KEY FK_6A10A677C54C8C93');
        $this->addSql('ALTER TABLE hospital_node DROP FOREIGN KEY FK_49E42046E2CF022');
        $this->addSql('DROP TABLE hospital_node');
        $this->addSql('DROP TABLE acts');
        $this->addSql('DROP TABLE dmp');
        $this->addSql('DROP TABLE file');
        $this->addSql('DROP TABLE history');
        $this->addSql('DROP TABLE history_dmp');
        $this->addSql('DROP TABLE personnal');
        $this->addSql('DROP TABLE personnal_specialization');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE specialization');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE type_node');
    }
}
