-- Edit auction information
UPDATE auction
SET title = $tile, description = $description, increment_fixed = $increment_fixed, increment_percent = $increment_percent, start_date = $start_date, end_date = $end_date, category = $category, nsfw = $nsfw;
WHERE id = $id;