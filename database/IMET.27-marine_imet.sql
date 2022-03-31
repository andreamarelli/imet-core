BEGIN;

ALTER TABLE imet.context_general_info ADD COLUMN IF NOT EXISTS "MarineDesignation" varchar(250);

COMMIT;
