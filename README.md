# test.module

action проверял так:

    <script>
        let userId = 559;
        BX.ajax.runAction(
            'rd:test.user.getUserNameVowels',
            {
                method: 'POST',
                data: {
                    userId: userId
                }
            })
            .then(
                function (response) {
                    console.log('response', response);
                }
            ).catch(
            function (response) {
                console.error('response', response);
            });
    </script>

--------------------------------------
rest проверял через хук:
/rest/1/k2jn6syll6i3xxby/get.username.vowels.json?userId=559