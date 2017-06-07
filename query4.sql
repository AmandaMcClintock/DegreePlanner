Select count(numOfCourses) FROM bucket_of_electives; WHERE dname = "BS in Mathematics";
Select count(cNo) FROM required WHERE dname ="BS in Mathematics"; 
/*A combination of these two queries will give you total number of classes for the major simply replave dname */