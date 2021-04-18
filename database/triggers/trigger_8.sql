-- When a scheduled auction begins its status changes to *Open*

-- Cron job isn't for A06?

DROP FUNCTION IF EXISTS auction_begin CASCADE;
CREATE FUNCTION auction_begin() RETURNS TRIGGER AS
$BODY$
BEGIN

END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS auction_begin on auction CASCADE;
CREATE TRIGGER auction_begin
	AFTER INSERT ON auction
	FOR EACH ROW
	EXECUTE PROCEDURE auction_begin();