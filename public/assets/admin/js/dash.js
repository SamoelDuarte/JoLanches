const Page = {
    init: () => {
        Page.setListeners();
    },

    setListeners: () => {
        // date picker

        moment.locale('pt-br');

        var start = moment();
        var end = moment();

        function cb(start, end) {
            $("#filter-days span").html(
                start.format("DD/MM/YYYY") +
                " - " +
                end.format("DD/MM/YYYY")

            );

            orderDash(start.format("YYYY-MM-DD"), end.format("YYYY-MM-DD"));
        }

        $("#filter-days").daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                "Hoje": [moment(), moment()],
                "Ontem": [
                    moment().subtract(1, "days"),
                    moment().subtract(1, "days"),
                ],
                "Últimos 7 dias": [moment().subtract(6, "days"), moment()],
                "Últimos 30 dias": [moment().subtract(29, "days"), moment()],
                "Esse mês": [
                    moment().startOf("month"),
                    moment().endOf("month"),
                ],
                "Mês passado": [
                    moment().subtract(1, "month").startOf("month"),
                    moment().subtract(1, "month").endOf("month"),
                ],
            },
            locale: {
                format: "DD/MM/YYYY",
                separator: " - ",
                applyLabel: "Aplicar",
                cancelLabel: "Cancelar",
                fromLabel: "De",
                toLabel: "Até",
                customRangeLabel: "Personalizado",
                months: [
                    "Jan", "Fev", "Mar", "Abr", "Mai", "Jun",
                    "Jul", "Ago", "Set", "Out", "Nov", "Dez"
                ],
                monthsShort: [
                    "Jan", "Fev", "Mar", "Abr", "Mai", "Jun",
                    "Jul", "Ago", "Set", "Out", "Nov", "Dez"
                ],
                daysOfWeek: [
                    "Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb",
                ],
                monthNames: [
                    "Janeiro",
                    "Fevereiro",
                    "Março",
                    "Abril",
                    "Maio",
                    "Junho",
                    "Julho",
                    "Agosto",
                    "Setembro",
                    "Outubro",
                    "Novembro",
                    "Dezembro",
                ],
                firstDay: 0,
            },
        }, cb);

        cb(start, end);

        function orderDash(start, end) {

            // getconfigDaysDashborad(start, end);
            tableError(start, end)
        }

        function getconfigDaysDashborad(start, end) {
            let dateStart = start.format("YYYY-MM-DD");
            let dateEnd = end.format("YYYY-MM-DD");

            $.ajax({
                type: "GET",
                dataType: "JSON",
                data: {
                    dateStart,
                    dateEnd
                },
                url: "/dashboard/get-days-dashborad",
                beforeSend: () => {
                    Utils.isLoading();
                },
                success: (data) => {
                  
                    // Atualize os valores nas caixas de entrada, saída e total
                    $(".box1 p").text("R$ " + data.sangriaTotal);
                    $(".box2 p").text("R$ " + data.vendaTotal);

                    // Calcule o total e atualize a caixa total
                    var total = data.vendaTotal - data.sangriaTotal;
                    $(".box2").css("background", total >= 0 ? 'var(--Green)' : 'var(--Red)');
                    $(".box2 p").text("R$ " + total);
                },
                error: (xhr) => { },
                complete: () => { },
            });
            initTable(dateStart, dateEnd);
            initTableLastLocation();
        }

        function tableError(start, end) {
            let dateStart = start;
            let dateEnd = end;
            $.ajax({
                type: "GET",
                dataType: "JSON",
                data: {
                    dateStart,
                    dateEnd
                },
                url: "/admin/getDash",
                beforeSend: () => {
                    Utils.isLoading();
                },
                success: (data) => {
                    console.log(data)
                    // Atualize os valores nas caixas de entrada, saída e total
                    $(".box1 p").text("R$ " + data.vendaTotal);
                    $(".sangria p").text("R$ " + data.sangriaTotal);

                    // Calcule o total e atualize a caixa total
                    $(".box2").css("background", parseFloat(data.total) >= 0 ? 'var(--Green)' : 'var(--Red)');
                    $(".box2 p").text("R$ " + data.total);


                },
                error: (xhr) => { },
                complete: () => {
                    Utils.isLoading(false);
                },
            });

        }

        function initTable(start, end) {
            $.ajax({
                type: "GET",
                dataType: "JSON",
                data: {
                    start,
                    end
                },
                url: "/admin/getDash",
                beforeSend: () => {
                    Utils.isLoading();
                },
                success: (data) => {
              
                    // Atualize os valores nas caixas de entrada, saída e total
                    $(".box1 p").text("R$ " + data.sangriaTotal);
                    $(".box2 p").text("R$ " + data.vendaTotal);

                    // Calcule o total e atualize a caixa total
                    var total = data.vendaTotal - data.sangriaTotal;
                    $(".box2").css("background", total >= 0 ? 'var(--Green)' : 'var(--Red)');
                    $(".box2 p").text("R$ " + total);

                },
                error: (xhr) => {

                },
                complete: () => {
                    Utils.isLoading(false);
                },
            });
        }

        function upChart(data) {
            chart.updateSeries(
                [{
                    data: data.data
                }]
            )
        }

     
    },
};
Page.init();