  var Currency = {
    rates: {"USD":1.0,"EUR":1.19822,"GBP":1.39881,"CAD":0.79789,"ARS":0.0110169,"AUD":0.778661,"BRL":0.180628,"CLP":0.00140195,"CNY":0.153989,"CYP":0.397899,"CZK":0.0457519,"DKK":0.16113,"EEK":0.0706676,"HKD":0.128887,"HUF":0.0032818,"ISK":0.00780568,"INR":0.0137622,"JMD":0.00666263,"JPY":0.00921126,"LVL":1.57329,"LTL":0.320236,"MTL":0.293496,"MXN":0.0484984,"NZD":0.722683,"NOK":0.118853,"PLN":0.261431,"SGD":0.746378,"SKK":21.5517,"SIT":175.439,"ZAR":0.0674116,"KRW":0.000884524,"SEK":0.118323,"CHF":1.08136,"TWD":0.0356978,"UYU":0.0224448,"MYR":0.243471,"BSD":1.0,"CRC":0.00163392,"RON":0.24537,"PHP":0.0206562,"AED":0.272294,"VEB":0.000100125,"IDR":6.94987e-05,"TRY":0.133721,"THB":0.0327328,"TTD":0.14723,"ILS":0.30237,"SYP":0.00195017,"XCD":0.370025,"COP":0.000281208,"RUB":0.0136363,"HRK":0.157857,"KZT":0.00238369,"TZS":0.00043125,"XPT":1203.54,"SAR":0.266667,"NIO":0.0284115,"LAK":0.00010681,"OMR":2.60078,"AMD":0.00192669,"CDF":0.000506965,"KPW":0.00111116,"SPL":6.0,"KES":0.00912461,"ZWD":0.00276319,"KHR":0.00024649,"MVR":0.0653115,"GTQ":0.129583,"BZD":0.496089,"BYR":3.86264e-05,"LYD":0.225502,"DZD":0.00751191,"BIF":0.000509635,"GIP":1.39881,"BOB":0.144948,"XOF":0.00182667,"STD":4.83227e-05,"NGN":0.00262486,"PGK":0.284999,"ERN":0.0666667,"MWK":0.00128088,"CUP":0.0377358,"GMD":0.0194578,"CVE":0.0108662,"BTN":0.0137622,"XAF":0.00182667,"UGX":0.000272935,"MAD":0.111415,"MNT":0.000350749,"LSL":0.0674116,"XAG":26.1246,"TOP":0.443594,"SHP":1.39881,"RSD":0.010191,"HTG":0.0130114,"MGA":0.000264725,"MZN":0.0135089,"FKP":1.39881,"BWP":0.0910082,"HNL":0.0415382,"PYG":0.000150073,"JEP":1.39881,"EGP":0.0636905,"LBP":0.00066335,"ANG":0.558667,"WST":0.399408,"TVD":0.778661,"GYD":0.00478754,"GGP":1.39881,"NPR":0.00856123,"KMF":0.00243556,"IRR":2.37955e-05,"XPD":2359.96,"SRD":0.0706595,"TMM":5.72488e-05,"SZL":0.0674116,"MOP":0.125133,"BMD":1.0,"XPF":0.0100411,"ETB":0.0248393,"JOD":1.41044,"MDL":0.056771,"MRO":0.00278042,"YER":0.00399404,"BAM":0.612639,"AWG":0.558659,"PEN":0.27076,"VEF":0.100125,"SLL":9.80662e-05,"KYD":1.21951,"AOA":0.00161298,"TND":0.36766,"TJS":0.0877409,"SCR":0.047206,"LKR":0.00508783,"DJF":0.0056252,"GNF":9.94481e-05,"VUV":0.00924057,"SDG":0.00263754,"IMP":1.39881,"GEL":0.301027,"FJD":0.492288,"DOP":0.0173938,"XDR":1.43283,"MUR":0.0249252,"MMK":0.000709058,"LRD":0.005751,"BBD":0.5,"ZMK":4.55406e-05,"XAU":1723.1,"VND":4.32312e-05,"UAH":0.0360616,"TMT":0.286244,"IQD":0.000685317,"BGN":0.612639,"KGS":0.0117923,"RWF":0.00101956,"BHD":2.65957,"UZS":9.49205e-05,"PKR":0.00636129,"MKD":0.0193108,"AFN":0.0128875,"NAD":0.0674116,"BDT":0.0117913,"AZN":0.588589,"SOS":0.00173331,"QAR":0.274725,"PAB":1.0,"CUC":1.0,"SVC":0.114286,"SBD":0.126698,"ALL":0.00967289,"BND":0.746378,"KWD":3.30707,"GHS":0.17421,"ZMW":0.0455406,"XBT":56390.7,"NTD":0.0337206,"BYN":0.386264,"CNH":0.154282,"MRU":0.0278042,"STN":0.0483227,"VES":5.34524e-07,"MXV":0.318766},
    convert: function(amount, from, to) {
      return (amount * this.rates[from]) / this.rates[to];
    }
  };
