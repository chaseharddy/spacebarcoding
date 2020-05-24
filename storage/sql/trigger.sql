/* student delete triggers */
CREATE TRIGGER remove_student_from_studenttocomputer
  AFTER DELETE on students
  FOR EACH ROW

  DELETE FROM studenttocomputer
  WHERE studenttocomputer.student_id = old.id
  ;


/* computer delete triggers */
CREATE TRIGGER remove_computer_from_studenttocomputer
  AFTER DELETE on computers
  FOR EACH ROW

  DELETE FROM studenttocomputer
  WHERE studenttocomputer.computer_id = old.id
  ;

