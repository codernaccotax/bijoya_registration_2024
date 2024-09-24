select 'between 8 and 13' as group_title,sex,food_habit,count(*) as student_count from event_registrations where age>8 and age<=13 group by sex,food_habit
union
select 'between 14 and 17' as group_title,sex,food_habit,count(*) as student_count from event_registrations where age>13 and age<=17 group by sex,food_habit
union
select 'between 18 and 24' as group_title,sex,food_habit,count(*) as student_count from event_registrations where age>17 and age<=24 group by sex,food_habit
union
select 'between 25 and 35' as group_title,sex,food_habit,count(*) as student_count from event_registrations where age>24 and age<=35 group by sex,food_habit
union
select 'between 36 and 50' as group_title,sex,food_habit,count(*) as student_count from event_registrations where age>36 and age<=50 group by sex,food_habit
union
select 'Morethan ' as group_title,sex,food_habit,count(*) as student_count from event_registrations where age>50 group by sex,food_habit








select group_title
,ifnull(sum(vegMale),0) as vegMale
,ifnull(sum(nonvegMale),0) as nonvegMale
,ifnull(sum(nonvegFemale),0) as nonvegFemale
,ifnull(sum(vegFemale),0) as vegFemale
,ifnull(sum(vegMale),0)+ifnull(sum(vegFemale),0) as total_veg
,ifnull(sum(nonvegMale),0)+ifnull(sum(nonvegFemale),0) as total_nonveg
,ifnull(sum(vegMale),0)+ifnull(sum(vegFemale),0)+ifnull(sum(nonvegMale),0)+ifnull(sum(nonvegFemale),0) as total_count
from (select group_title,
case WHEN sex="male" and food_habit="veg" 
  THEN ifnull(student_count,0) 
END AS vegMale,
case WHEN sex="male" and food_habit="nonveg" 
  THEN ifnull(student_count,0)  
END AS nonvegMale,
case WHEN sex="female" and food_habit="nonveg" 
  THEN ifnull(student_count,0) 
END AS nonvegFemale,
case WHEN sex="female" and food_habit="veg" 
  THEN ifnull(student_count,0)  
END AS vegFemale
from
(select 'between 8 and 13' as group_title,sex,food_habit,count(*) as student_count from event_registrations where age>8 and age<=13 group by sex,food_habit

union
select 'between 14 and 17' as group_title,sex,food_habit,count(*) as student_count from event_registrations where age>13 and age<=17 group by sex,food_habit
union
select 'between 18 and 24' as group_title,sex,food_habit,count(*) as student_count from event_registrations where age>17 and age<=24 group by sex,food_habit
union
select 'between 25 and 35' as group_title,sex,food_habit,count(*) as student_count from event_registrations where age>24 and age<=35 group by sex,food_habit
union
select 'between 36 and 50' as group_title,sex,food_habit,count(*) as student_count from event_registrations where age>36 and age<=50 group by sex,food_habit
union
select 'Morethan ' as group_title,sex,food_habit,count(*) as student_count from event_registrations where age>50 group by sex,food_habit
) as table1
group by group_title,food_habit, sex) as table2 group by group_title
union
select 'Total of Group'
,ifnull(sum(vegMale),0) as vegMale
,ifnull(sum(nonvegMale),0) as nonvegMale
,ifnull(sum(nonvegFemale),0) as nonvegFemale
,ifnull(sum(vegFemale),0) as vegFemale
,ifnull(sum(vegMale),0)+ifnull(sum(vegFemale),0) as total_veg
,ifnull(sum(nonvegMale),0)+ifnull(sum(nonvegFemale),0) as total_nonveg
,ifnull(sum(vegMale),0)+ifnull(sum(vegFemale),0)+ifnull(sum(nonvegMale),0)+ifnull(sum(nonvegFemale),0) as total_count
from (select group_title,
case WHEN sex="male" and food_habit="veg" 
  THEN ifnull(student_count,0) 
END AS vegMale,
case WHEN sex="male" and food_habit="nonveg" 
  THEN ifnull(student_count,0)  
END AS nonvegMale,
case WHEN sex="female" and food_habit="nonveg" 
  THEN ifnull(student_count,0) 
END AS nonvegFemale,
case WHEN sex="female" and food_habit="veg" 
  THEN ifnull(student_count,0)  
END AS vegFemale
from
(select 'between 8 and 13' as group_title,sex,food_habit,count(*) as student_count from event_registrations where age>8 and age<=13 group by sex,food_habit

union
select 'between 14 and 17' as group_title,sex,food_habit,count(*) as student_count from event_registrations where age>13 and age<=17 group by sex,food_habit
union
select 'between 18 and 24' as group_title,sex,food_habit,count(*) as student_count from event_registrations where age>17 and age<=24 group by sex,food_habit
union
select 'between 25 and 35' as group_title,sex,food_habit,count(*) as student_count from event_registrations where age>24 and age<=35 group by sex,food_habit
union
select 'between 36 and 50' as group_title,sex,food_habit,count(*) as student_count from event_registrations where age>36 and age<=50 group by sex,food_habit
union
select 'Morethan ' as group_title,sex,food_habit,count(*) as student_count from event_registrations where age>50 group by sex,food_habit
) as table1
group by group_title,food_habit, sex) as table3 