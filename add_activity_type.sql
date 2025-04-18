ALTER TABLE meditation_sessions
ADD COLUMN activity_type VARCHAR(20) NOT NULL DEFAULT 'meditation' AFTER session_type; 