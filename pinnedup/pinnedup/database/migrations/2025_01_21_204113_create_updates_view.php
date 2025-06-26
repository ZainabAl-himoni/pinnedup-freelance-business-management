<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Safely drop the existing view
        DB::statement("DROP VIEW IF EXISTS `updates`");

        // Re-create the view with corrected UNION for proposals
        DB::statement("
            CREATE VIEW `updates` AS
                SELECT 
                    id,
                    CAST(name AS CHAR CHARACTER SET utf8mb4) AS name,
                    CAST(status AS CHAR CHARACTER SET utf8mb4) AS status,
                    updated_at,
                    'Lead' AS type
                FROM leads

                UNION ALL

                SELECT
                    id,
                    CAST(CONCAT('Proposal #', id) AS CHAR CHARACTER SET utf8mb4) AS name,
                    NULL AS status,
                    updated_at,
                    'Proposal' AS type
                FROM proposals

                UNION ALL

                SELECT
                    id,
                    CAST(name AS CHAR CHARACTER SET utf8mb4) AS name,
                    CAST(status AS CHAR CHARACTER SET utf8mb4) AS status,
                    updated_at,
                    'Client' AS type
                FROM clients

                UNION ALL

                SELECT
                    id,
                    CAST(name AS CHAR CHARACTER SET utf8mb4) AS name,
                    CAST(status AS CHAR CHARACTER SET utf8mb4) AS status,
                    updated_at,
                    'Task' AS type
                FROM tasks

                UNION ALL

                SELECT
                    id,
                    CAST(name AS CHAR CHARACTER SET utf8mb4) AS name,
                    CAST(status AS CHAR CHARACTER SET utf8mb4) AS status,
                    updated_at,
                    'Project' AS type
                FROM projects

                UNION ALL

                SELECT
                    id,
                    CAST(amount AS CHAR CHARACTER SET utf8mb4) AS name,
                    CAST(status AS CHAR CHARACTER SET utf8mb4) AS status,
                    updated_at,
                    'Invoice' AS type
                FROM invoices

                UNION ALL

                SELECT
                    id,
                    CAST(name AS CHAR CHARACTER SET utf8mb4) AS name,
                    CAST(
                        CONCAT(
                            IF(behance IS NOT NULL AND behance != '', CONCAT('Behance: ', behance), ''),
                            IF(dribbble IS NOT NULL AND dribbble != '', CONCAT(' | Dribbble: ', dribbble), ''),
                            IF(linkedin IS NOT NULL AND linkedin != '', CONCAT(' | LinkedIn: ', linkedin), ''),
                            IF(github IS NOT NULL AND github != '', CONCAT(' | GitHub: ', github), '')
                        )
                        AS CHAR CHARACTER SET utf8mb4
                    ) AS status,
                    updated_at,
                    'User' AS type
                FROM users
        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS `updates`");
    }
};
