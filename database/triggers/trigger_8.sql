-- When a scheduled auction begins its status changes to *Open*

-- Cron job isn't for A06?

CREATE FUNCTION auction_begin() RETURNS TRIGGER AS
$BODY$
BEGIN

END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER auction_begin
	AFTER INSERT ON auction
	FOR EACH ROW
	EXECUTE PROCEDURE auction_begin();