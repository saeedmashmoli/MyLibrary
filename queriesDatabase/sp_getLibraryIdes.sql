create procedure sp_getlibraryides
@test int
as
begin
select distinct t3.library_id as li from 
questionbank_test as t1
left join 
question_questionbank as t2
on t1.questionbank_id = t2.questionbank_id
left join
library_question as t3
on t3.question_id = t2.question_id
where
t1.test_id = @test
end