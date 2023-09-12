BEGIN;

ALTER TABLE imet.imet_form ADD COLUMN IF NOT EXISTS sync_unique_id varchar(10) default null;
ALTER TABLE imet.imet_form ADD COLUMN IF NOT EXISTS synced boolean default false;

COMMIT;
