<?php
/**
 * @author Kristjan Siimson <dev@siimsoni.ee>
 * @group Lib
 */
class GeocodeTest extends CIUnit_TestCase
{
    public function setUp()
    {
        $this->CI->load->spark('ja-geocode/1.2.0');
    }

    public function testQueryCity()
    {
        $resultObject = $this->CI->ja_geocode->query('Tallinn');
        $resultArray = json_decode(json_encode($resultObject), true);

        $this->assertEquals(
            $this->getGeocodeAPIResultForQueryTallinn(),
            var_export(Spyc::YAMLDump($resultArray), true)
        );
    }

    /**
     * @return string
     */
    private function getGeocodeAPIResultForQueryTallinn()
    {
        return file_get_contents(__DIR__. '/fixtures/' . __METHOD__ . '-001.yml');
    }
}