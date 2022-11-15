select oYearsEstablished, AVG(iOutletSales) as avgSales
from yearsEstablishedSales
GROUP BY oYearsEstablished;